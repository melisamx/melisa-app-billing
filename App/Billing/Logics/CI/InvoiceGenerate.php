<?php

namespace App\Billing\Logics\CI;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Invoice\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Modules\Universal\Invoice\ReportModule;
use App\Billing\Logics\Invoice\v32\PreviewLogic;
use App\Drive\Logics\Files\ReportLogic;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Invoice generate
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
    
    public function init(Invoice $invoice)
    {
        $serie = $this->getSerie();
        
        if( !$serie) {
            return false;
        }
        
        if( !$this->setSeries($invoice, $serie)) {
            return false;
        }        
        
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $params = $this->getRequestParamsXml();
        
        $fileCer = $this->getFileCer();
        $fileKey = $this->getFileKey();
        
        $xsltString = $this->getXsltStrinOriginal();    
        
        if( !$xsltString) {
            return false;
        }
        
        $numberCertificate = $this->getNumberCertificate($fileCer);
        
        if( !$numberCertificate) {
            return false;
        }
        
        $xmlString = $this->generateXmlCfd($invoice);
        
        $idFileCfdBeforeSeal = $this->saveCfdBeforeSeal($invoice, $xmlString);
        
        if( !$idFileCfdBeforeSeal) {
            return $this->error('Imposible guardar CFD antes de ser sellado');
        }
        
        $sealXml = $this->getSealXml($xmlString, $xsltString, $fileKey, $fileCer, $numberCertificate);
        
        if( !$sealXml) {
            return false;
        }
        
        $sealXmlString = $sealXml->saveXML();
        $idFileCfdSeal = $this->saveCfdSeal($invoice, $sealXmlString);
        
        if( !$idFileCfdSeal) {
            return $this->error('Imposible guardar CFD despues de ser sellado');
        }
        
        $params ['CFD']= $sealXmlString;
        $stamp = $this->generateXml($client, $params);
        
        if( !$stamp) {
            return false;
        }
        
        if( !$this->isValidStamp($stamp)) {
            return false;
        }
        
        $dataBell = $this->getDataBell($stamp);
        
        if( !$dataBell) {
            return false;
        }
        
        if( !$this->updateSealXml($sealXml, $dataBell)) {
            return false;
        }
        
        $this->repoInvoice->beginTransaction();
        
        $idFileXmlBell = $this->saveFileXmlBell($sealXml->saveXML(), $dataBell);
        
        if( !$idFileXmlBell) {
            return $this->error('Imposible guardar XML timbrado {t}', [
                't'=>$sealXml->saveXML()
            ]);
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
            $idFileCfdSeal,
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
            'idFileCfdSeal'=>$idFileCfdSeal,
            'serie'=>$serie->serie,
            'folio'=>$serie->folioCurrent
        ];
    }
    
    public function getXsltStrinOriginal()
    {
        $filePath = __DIR__ . '/cadenaoriginal_3_0.xslt';
        
        if( !file_exists($filePath)) {
            return $this->error('Imposible leer archivo XSLT para generar cadena original');
        }
        
        $xslt = file_get_contents($filePath);
        
        if( !$xslt) {
            return $this->error('Imposible leer el archivo XSLT para generar cadena original');
        }
        
        return $xslt;
    }
    
    public function setSeries(Invoice &$invoice, &$serie)
    {
        $invoice->setSeries($serie->serie);
        $invoice->setFolio($serie->folioCurrent + 1);
        return true;
    }
    
    public function isValidStamp(&$stamp)
    {
        if( !isset($stamp['TimbrarResult'])) {
            return $this->error('Respuesta invalida por parte del prevalidador');
        }
        
        libxml_use_internal_errors(true);
        $doc = simplexml_load_string($stamp['TimbrarResult']);
        
        if( !$doc) {
            return $this->error(utf8_encode($stamp['TimbrarResult']));
        }
        
        $stamp = $stamp['TimbrarResult'];
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
    
    public function getSerie()
    {
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
    
    public function getStringOriginal(&$dataBell)
    {
        return implode('|', [
            '||1.0',
            $dataBell['uuid'],
            $dataBell['date'],
            $dataBell['sealCfd'],
            $dataBell['numberCertificateSat'],
            '|'
        ]);
    }
    
    public function createHtmlInvoice(&$invoice, &$dataBell)
    {        
        $data = app(PreviewLogic::class)->init($invoice);
        $data->uuid = $dataBell['uuid'];
        $data->date = $dataBell['date'];
        $data->numberCertificateSat = $dataBell['numberCertificateSat'];
        $data->stringOriginal = $this->getStringOriginal($dataBell);
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
    
    public function updateSealXml(&$sealXml, &$dataBell)
    {
        $comprobante = $sealXml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
        $complemento = $sealXml->createElement('cfdi:Complemento');
        $bell = $sealXml->createElement('tfd:TimbreFiscalDigital');
        $bell->setAttribute('xmlns:tfd', 'http://www.sat.gob.mx/TimbreFiscalDigital');
        $bell->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $bell->setAttribute('xsi:schemaLocation', 'http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/TimbreFiscalDigital/TimbreFiscalDigital.xsd');
        $bell->setAttribute('FechaTimbrado', $dataBell['date']);
        $bell->setAttribute('UUID', $dataBell['uuid']);
        $bell->setAttribute('noCertificadoSAT', $dataBell['numberCertificateSat']);
        $bell->setAttribute('selloSAT', $dataBell['sealSat']);
        $bell->setAttribute('selloCFD', $dataBell['sealCfd']);
        $bell->setAttribute('version', $dataBell['version']);
        $complemento->appendChild($bell);
        $comprobante->appendChild($complemento);
        return true;
    }
    
    public function getDataBell(&$bell)
    {
        $xmlTimbre = new \DOMDocument('1.0', 'UTF-8');
        $xmlTimbre->loadXML($bell);
        $timbreElement = $xmlTimbre->getElementsByTagName('timbre');
        
        if( !$timbreElement->length || $timbreElement[0]->getAttribute('esValido') !== 'True') {
            return $this->error('Respuesta invalida por parte de CI {r}', [
                'r'=>$bell
            ]);
        }
        
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
        if( env('CI_ENVIROMENT') === 'sandbox') {
            $invoice->getTransmitter()->setRfc(env('CI_RFC_TRANSMITTER'));
        }
        
        return view('layouts/ci/xml', [
            'invoice'=>$invoice
        ])->render();
    }
    
    public function getFileKey()
    {
        exec('openssl pkcs8 -inform DER -in ' . __DIR__ . '/CSD01_AAA010101AAA.key -passin pass:12345678a', $result, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible obtener el archivo PEM');
        }
        
        return implode(PHP_EOL, $result);
    }
    
    public function getFileCer()
    {
        return file_get_contents(__DIR__ . '/CSD01_AAA010101AAA.cer');
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
    
    public function getNumberCertificate(&$fileKey)
    {
        $pem = '-----BEGIN CERTIFICATE-----' . 
            PHP_EOL .
            chunk_split(base64_encode($fileKey), 64).
            '-----END CERTIFICATE-----' . 
            PHP_EOL;
        
        $infoCertificate = openssl_x509_parse($pem);
        
        if( !$infoCertificate) {
            return $this->error('Imposible obtener información del certificado');
        }
        
//        $hex = $this->bcdechex($infoCertificate['serialNumber']);
        $hex = $infoCertificate['serialNumberHex'];
        
        $numberCertificate = '';
        for ($i = 1; $i < strlen($hex); $i = $i+2) {
            $numberCertificate .= substr($hex, $i, 1);
        }
        
        return $numberCertificate;
    }
    
    private function bcdechex($dec) {
        $last = bcmod($dec, 16);
        $remain = bcdiv(bcsub($dec, $last), 16);
        if($remain == 0) {
            return dechex($last);
        } else {
            return $this->bcdechex($remain).dechex($last);
        }
    }
    
    public function getSealXml(&$xmlString, &$xsltString, $fileKey, &$fileCer, $numberCertificate)
    {
        // Crear un objeto DOMDocument para cargar el CFDI
        $xml = new \DOMDocument('1.0', 'UTF-8'); 
        // Cargar el CFDI
        $xml->loadXML($xmlString);
        
        // Crear un objeto DOMDocument para cargar el archivo de transformación XSLT
        $xsl = new \DOMDocument();
        $xsl->loadXML($xsltString);
        
        // Crear el procesador XSLT que nos generará la cadena original con base en las reglas descritas en el XSLT
        $proc = new \XSLTProcessor;
        // Cargar las reglas de transformación desde el archivo XSLT.
        @$proc->importStyleSheet($xsl);
        
        // Generar la cadena original y asignarla a una variable
        $this->stringOriginal = $proc->transformToXML($xml);
        
        $private = openssl_pkey_get_private($fileKey);
        
        if( !$private) {
            return $this->error('Al obtener clave privada');
        }
        
        $certificate = str_replace(['\n', '\r'], '', base64_encode($fileCer));
        
        openssl_sign($this->stringOriginal, $sig, $private);
        $seal = base64_encode($sig);
        
        $c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0); 
        $c->setAttribute('sello', $seal);
        $c->setAttribute('certificado', $certificate);
        $c->setAttribute('noCertificado', $numberCertificate);
        return $xml;
    }
    
    public function generateXml(&$client, $params)
    {
        $result = $this->runRequest($client, 'Timbrar', $params);
        
        if( !$result) {
            return $this->error('Imposible generar XML con CI');
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
            'stringOriginal'=>$this->getStringOriginal($dataBell),
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
