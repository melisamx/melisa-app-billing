<?php

namespace App\Billing\Logics\Provider\Profact;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\ReportLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Interfaces\Invoice\v32\Invoice;
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
    
    public function init(Invoice $invoice, $serie, $csd)
    {
        $serie = $this->getSerie($serie);
        
        if( !$serie) {
            return false;
        }
        
        $csd = $this->getCsd($csd);
        
        if( !$csd) {
            return false;
        }
        
        if( !$this->setSeries($invoice, $serie)) {
            return false;
        }
        
        if( !$this->setDate($invoice)) {
            return false;
        }
        
        $xmlString = $this->generateXmlCfd($invoice);
        
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
            return $this->error('Imposible guardar XML timbrado {t}', [
                't'=>$result['xml']
            ]);
        }
        
        $idFileQr = $this->saveFileQr($result['qr'], $dataBell);
        
        if( !$idFileQr) {
            return $this->error('Imposible guardar imagen QR');
        }
        
        $idFileHtmlInvoice = $this->createHtmlInvoice($invoice, $dataBell);
        
        if( !$idFileHtmlInvoice) {
            return false;
        }
        
        $fileHtml = $this->getFileDrive($idFileHtmlInvoice);
        
        if( !$fileHtml) {
            return $this->error('Imposible obtener el archivo HTML de la factura');
        }
        
        $stringPdf = $this->createPdfInvoide($fileHtml);
        
        if( !$stringPdf) {
            return false;
        }
        
        $idFilePdfInvoice = $this->saveFilePdf($invoice, $stringPdf);
        
        if( !$idFilePdfInvoice) {
            return false;
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
        
        if( !$this->incrementFolio($serie)) {
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
            'folio'=>$serie->folioCurrent
        ];
    }
    
    public function setSeries(Invoice &$invoice, &$serie)
    {
        $invoice->setSeries($serie->serie);
        $invoice->setFolio($serie->folioCurrent + 1);
        return true;
    }
    
    public function setDate(Invoice &$invoice)
    {
        $carbon = new \Carbon\Carbon('now');
        $formatted = $carbon->toRfc3339String();
        $invoice->setDate($formatted);
        return true;
    }
    
    public function incrementFolio(&$serie)
    {
        $serie->folioCurrent ++;
        $result = $serie->save();
        
        if( $result) {
            return true;
        }
        
        return $this->error('Imposible incrementar el folio de la serie {s}', [
            's'=>$serie->serie
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
    
    public function createPdfInvoide(&$fileHtml)
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
            return $this->error('Imposible generar factura en formato PDF: {e}', [
                'e'=>explode(PHP_EOL, $output)
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
        $idFileHtmlInvoice = $this->saveHtmlInvoice($invoice, $htmlInvoice);
        
        if( !$idFileHtmlInvoice) {
            return $this->error('Imposible guardar reporte HTML para generar PDF');
        }
        
        return $idFileHtmlInvoice;
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
    
    public function getNameFilesGenerate(&$invoice)
    {
        return implode('_', [
            $invoice->getSeries(),
            $invoice->getFolio(),
            $invoice->getReceiver()->getRfc()
        ]);
    }
    
    public function saveHtmlInvoice(&$invoice, &$htmlInvoice)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($invoice),
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
            $this->getNameFilesGenerate($invoice),
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
    
    public function generateXmlCfd(Invoice &$invoice)
    {
        /* CI use RFC test */
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            $invoice->getTransmitter()->setRfc(env('PROFACT_RFC_TRANSMITTER'));
        }
        
        $xml = view('layouts/ci/xml', [
            'invoice'=>$invoice
        ])->render();
        
        return $xml;
    }
    
    public function saveFilePdf(&$invoice, &$stringPdf)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($invoice),
            'before',
            'sealing'
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
        
        $result = $this->repoInvoice->create([
            'idVoucherType'=>1,
            'idIdentityCreated'=>$this->getIdentity(),
            'idInvoiceStatus'=>InvoiceStatus::NNEW,
            'idSerie'=>$serie->id,
            'idFileXml'=>$idFileXmlBell,
            'idFilePdf'=>$idFilePdfInvoice,
            'idFileCfdSeal'=>$idFileCfdSeal,
            'idFileCfdBeforeSeal'=>$idFileCfdBeforeSeal,
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
        
        return $this->error('Imposible crear registro de la factura');
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
