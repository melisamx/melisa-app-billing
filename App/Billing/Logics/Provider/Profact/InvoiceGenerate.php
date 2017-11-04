<?php

namespace App\Billing\Logics\Provider\Profact;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\ReportLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Invoice\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Modules\Universal\Invoice\ReportModule;
use App\Billing\Logics\Invoice\v32\PreviewLogic;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Invoice generate with Profact
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    use LogicBusiness, Client;
    
    protected $repoInvoice;
    protected $readerXml;
    protected $logicFile;
    protected $repoSeries;
    protected $libNumberToLetter;

    public function __construct(
        InvoiceRepository $repoInvoice,
        InvoiceXmlReader $readerXml,
        StringCreateLogic $logicFile,
        SeriesRepository $repoSeries,
        NumberToLetterConverter $libNumberToLetter
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->readerXml = $readerXml;
        $this->logicFile = $logicFile;
        $this->repoSeries = $repoSeries;
        $this->libNumberToLetter = $libNumberToLetter;
    }
    
    public function init($invoice)
    {
        dd($invoice);        
        $xmlString = $this->generateXmlCfd($invoice);
        dd($xmlString);
        $idFileCfdBeforeSeal = $this->saveCfdBeforeSeal($invoice, $xmlString);
        
        if( !$idFileCfdBeforeSeal) {
            return $this->error('Imposible guardar CFD antes de ser sellado');
        }
        
        $params = $this->getClientParams([
            'xmlComprobanteBase64'=>base64_encode($xmlString)
        ]);
        
        $client = $this->createClient($params);
        
        $result = $this->generateXml($client, $params);
        
        if( !$result) {
            return false;
        }
        
        $dataBell = $this->getDataBell($result['xml']);
        
        if( !$dataBell) {
            return false;
        }
        
        $dataBell ['stringOriginal']= $result['stringOriginal'];
        
        $this->repoInvoice->beginTransaction();
        
        $idFileXmlBell = $this->saveFileXmlBell($result['xml'], $dataBell);
        
        if( !$idFileXmlBell) {
            return $this->error('Imposible guardar XML timbrado {t} de la factura {u}', [
                't'=>$result['xml'],
                'u'=>$dataBell['uuid'],
            ]);
        }
        
        $idFileQr = $this->saveFileQr($result['qr'], $dataBell);
        
        if( !$idFileQr) {
            return $this->error('Imposible guardar imagen QR de la factura {u}', [
                'u'=>$dataBell['uuid'],
            ]);
        }
        
        $idFileHtmlInvoice = $this->createHtmlInvoice($invoice, $dataBell);
        
        if( !$idFileHtmlInvoice) {
            return false;
        }
        
        $fileHtml = $this->getFileDrive($idFileHtmlInvoice);
        
        if( !$fileHtml) {
            return $this->error('Imposible obtener el archivo HTML de la factura {u}', [
                'u'=>$dataBell['uuid'],
            ]);
        }
        
        $stringPdf = $this->createPdfInvoide($fileHtml, $dataBell['uuid']);
        
        if( !$stringPdf) {
            return false;
        }
        
        $idFilePdfInvoice = $this->saveFilePdf($invoice, $dataBell, $stringPdf);
        
        if( !$idFilePdfInvoice) {
            return $this->error('Imposible guardar PDF de la factura {u}', [
                'u'=>$dataBell['uuid'],
            ]);
        }
        
        $idInvoice = $this->createInvoice(
            $idFileCfdBeforeSeal,
            $idFileQr,
            $idFileXmlBell, 
            $idFilePdfInvoice, 
            $dataBell, 
            $invoice,
            $serie
        );
        
        if( !$idInvoice) {
            return $this->repoInvoice->rollback();
        }
        
        if( !$this->incrementFolio($serie, $dataBell['uuid'])) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();        
        return [
            'idInvoice'=>$idInvoice,
            'idFileXml'=>$idFileXmlBell,
            'idFilePdf'=>$idFilePdfInvoice,
            'idFileCfdBeforeSeal'=>$idFileCfdBeforeSeal,
            'idFileQr'=>$idFileQr,
            'serie'=>$serie->serie,
            'folio'=>$serie->folioCurrent,
            'uuid'=>$dataBell['uuid']
        ];
    }
    
    public function incrementFolio(&$serie, $uuid)
    {
        $serie->folioCurrent ++;
        $result = $serie->save();
        
        if( $result) {
            return true;
        }
        
        return $this->error('Imposible incrementar el folio de la serie {s} al generar factura {u}', [
            's'=>$serie->serie,
            'u'=>$uuid
        ]);
    }
    
    public function getCsd(&$csd)
    {
        if( $csd) {
            return $csd;
        }
        
        return $this->error('CSD no especific');
    }
    
    public function getSerie(&$serie)
    {
        if( $serie) {
            return $serie;
        }
        
        $serie = $this->repoSeries->findWhere([
            'isDefault'=>true,
            'active'=>true
        ])->first();
        
        if( !$serie) {
            return $this->error('Imposible obtener la serie a usar en la factura');
        }
        
        return $serie;
    }
    
    public function getFileDrive($idFile)
    {
        return app(ReportLogic::class)->init($idFile);
    }
    
    public function createPdfInvoide(&$fileHtml, $uuid)
    {
        $nameOutput = pathinfo($fileHtml->originalFilename);
        $nameOutput = $fileHtml->unit->source .
            $nameOutput['filename'] . 
            '.pdf';
        
        $command = implode('', [
            'wkhtmltopdf ',
            '-s Letter --encoding "UTF-8" -L 0 -R 0 -T 0 -B 0 "file://',
            $fileHtml->unit->source,
            $fileHtml->originalFilename,
            '" ',
            $nameOutput
        ]);
        
        $output = [];
        exec($command, $output, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible generar factura ({u}) en formato PDF: {e}', [
                'e'=>explode(PHP_EOL, $output),
                'u'=>$uuid
            ]);
        }
        
        $content = file_get_contents($nameOutput);
        @unlink($nameOutput);
        return $content;
    }
    
    public function createHtmlInvoice(&$invoice, &$dataBell)
    {
        $data = app(PreviewLogic::class)->init($invoice);
        $data->uuid = $dataBell['uuid'];
        $data->date = $dataBell['date'];
        $data->numberCertificateSat = $dataBell['numberCertificateSat'];
        $data->stringOriginal = $dataBell['stringOriginal'];
        $data->sealCfd = $dataBell['sealCfd'];
        $data->sealSat = $dataBell['sealSat'];
        $data->totalLetter = $this->libNumberToLetter->convertir($data->total);
        
        $module = app(ReportModule::class)
            ->withInput($data)
            ->render();
        $htmlInvoice = $module->render();
        $idFileHtmlInvoice = $this->saveHtmlInvoice($invoice, $htmlInvoice, $dataBell);
        
        if( !$idFileHtmlInvoice) {
            return $this->error('Imposible guardar reporte HTML para generar PDF de la factura {u}', [
                'u'=>$dataBell['uuid'],
            ]);
        }
        
        return $idFileHtmlInvoice;
    }
    
    public function saveHtmlInvoice(&$invoice, &$htmlInvoice, &$dataBell)
    {
        $name = implode('_', [
            $dataBell['uuid'],
            'html'
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.html')
            ->setOriginalName($name)
            ->setExtension('html')
            ->setContent($htmlInvoice);
        
        return $this->logicFile->init($file);
    }
    
    public function getDataBell(&$bell)
    {
        $xmlTimbre = new \DOMDocument('1.0', 'UTF-8');
        $xmlTimbre->loadXML($bell);
        
        $c = $xmlTimbre->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital')->item(0); 
        return [
            'date'=>$c->getAttribute('FechaTimbrado'),
            'sealCfd'=>$c->getAttribute('selloCFD'),
            'version'=>$c->getAttribute('version'),
            'numberCertificateSat'=>$c->getAttribute('noCertificadoSAT'),
            'sealSat'=>$c->getAttribute('selloSAT'),
            'uuid'=>$c->getAttribute('UUID')
        ];
    }
    
    public function saveCfdSeal(&$invoice, &$xmlString)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($invoice),
            'sealed'
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.xml')
            ->setOriginalName($name)
            ->setExtension('xml')
            ->setContent($xmlString);
        
        return $this->logicFile->init($file);
    }
    
    public function saveCfdBeforeSeal(&$invoice, &$xmlString)
    {
        $name = implode('_', [
            $invoice->getSeries(),
            $invoice->getFolio(),
            $invoice->getReceiver()->getRfc(),
            'before',
            'sealing'
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.xml')
            ->setOriginalName($name)
            ->setExtension('xml')
            ->setContent($xmlString);
        
        return $this->logicFile->init($file);
    }
    
    public function generateXmlCfd(&$invoice)
    {
        /* CI use RFC test */
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            $invoice->transmitter->rfc = env('PROFACT_RFC_TRANSMITTER');
        }
        
        $xml = view('layouts/ci/xml', [
            'invoice'=>$invoice
        ])->render();
        
        return $xml;
    }
    
    public function saveFilePdf(&$invoice, &$dataBell, &$stringPdf)
    {
        $name = implode('_', [
            'invoice_',
            $dataBell['uuid']
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.pdf')
            ->setOriginalName($name)
            ->setExtension('pdf')
            ->setContent($stringPdf);
        
        return $this->logicFile->init($file);
    }
    
    public function saveFileQr($content, &$dataBell)
    {
        $file = new FileContent();
        $file
            ->setName($dataBell['uuid'] . '.jpg')
            ->setOriginalName($dataBell['uuid'])
            ->setExtension('jpg')
            ->setContent($content);
        
        return $this->logicFile->init($file);
    }
    
    public function saveFileXmlBell($sealXml, &$dataBell)
    {
        $file = new FileContent();
        $file
            ->setName($dataBell['uuid'] . '.xml')
            ->setOriginalName($dataBell['uuid'])
            ->setExtension('xml')
            ->setContent($sealXml);
        
        return $this->logicFile->init($file);
    }
    
    public function updateInvoice($idInvoice, $data)
    {
        return $this->repoInvoice->update($data, $idInvoice);
    }
    
    public function generatePdf($client, $params)
    {
        $result = $this->runRequest($client, 'GeneraPDF', $params);
        
        if( !$result) {
            return $this->error('Imposible generar PDF con Digifact');
        }
        
        return $result['GeneraPDFResult'];
    }
    
    public function generateXml(&$client, $params)
    {
        $result = $this->runRequest($client, 'TimbraCFDI', [
            'parameters'=>$params
        ]);
        
        if( !$result) {
            return $this->error('Imposible generar XML con Profact');
        }
        
        return $result;
    }
    
    public function createInvoice(
        $idFileCfdBeforeSeal,
        $idFileCfdSeal,
        $idFileXmlBell, 
        $idFilePdfInvoice, 
        $dataBell, 
        $invoice,
        $serie
    )
    {
        $taxes = array_map(function($tax) {
            return $tax->toArray();
        }, $invoice->getTaxes());
        $concepts = array_map(function($concept) {
            return $concept->toArray();
        }, $invoice->getConcepts());
        $extraData = $invoice->getExtraData();
        
        $result = $this->repoInvoice->create([
            'idVoucherType'=>1,
            'idIdentityCreated'=>$this->getIdentity(),
            'idInvoiceStatus'=>InvoiceStatus::NNEW,
            'idSerie'=>$serie->id,
            'idFileXml'=>$idFileXmlBell,
            'idFilePdf'=>$idFilePdfInvoice,
            'idFileCfdSeal'=>$idFileCfdSeal,
            'idFileCfdBeforeSeal'=>$idFileCfdBeforeSeal,
            'idCustomer'=>$extraData->idCustomer,
            'idContributorAddress'=>$extraData->idContributorAddress,
            'rfc'=>$invoice->getReceiver()->getRfc(),
            'name'=>$invoice->getReceiver()->getBusinessName(),
            'uuid'=>$dataBell['uuid'],
            'folio'=>$invoice->getFolio(),
            'serie'=>$invoice->getSeries(),
            'date'=>$dataBell['date'],
            'sealCfd'=>$dataBell['sealCfd'],
            'sealSat'=>$dataBell['sealSat'],
            'voucherType'=>$invoice->getVoucherType(),
            'methodPayment'=>$invoice->getMethodPayment(),
            'expeditionPlace'=>$invoice->getExpeditionPlace(),
            'coin'=>$invoice->getCoin(),
            'numberCertificateSat'=>$dataBell['numberCertificateSat'],
            'stringOriginal'=>$dataBell['stringOriginal'],
            'version'=>$invoice->getVersion(),
            'rfcTransmitter'=>$invoice->getTransmitter()->getRfc(),
            'nameTransmitter'=>$invoice->getTransmitter()->getBusinessName(),
            'receiver'=>json_encode($invoice->getReceiver()->toArray()),
            'transmitter'=>json_encode($invoice->getTransmitter()->toArray()),
            'concepts'=>json_encode($concepts),
            'taxes'=>json_encode($taxes),
            'total'=>$invoice->getTotal(),
            'subTotal'=>$invoice->getSubTotal()
        ]);
        
        if( $result)  {
            return $result;
        }
        
        return $this->error('Imposible crear registro de la factura {u}', [
            'u'=>$dataBell['uuid']
        ]);
    }
    
    public function getRequestParamsPdf(&$dataXml)
    {
        return [
            'Usuario'=>$this->getUser(),
            'Contrasena'=>$this->getPass(),
            'Serie'=>$dataXml['serie'],
            'Folio'=>$dataXml['folio'],
        ];
    }
    
    public function getRequestParamsXml()
    {
        $formatInvoice ['LoginWS']= $this->getUser();
        $formatInvoice ['PasswordWS']= $this->getPass();
        return $formatInvoice;
    }
    
}
