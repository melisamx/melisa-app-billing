<?php

namespace App\Billing\Logics\Provider\Ci;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\ReportLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Interfaces\Documents\v32\Documents;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Documents\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Modules\Universal\Documents\ReportModule;
use App\Billing\Logics\Documents\v32\PreviewLogic;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Documents generate
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
    
    public function init(Documents $documents, $serie, $csd)
    {
        $serie = $this->getSerie($serie);
        
        if( !$serie) {
            return false;
        }
        
        $csd = $this->getCsd($csd);
        
        if( !$csd) {
            return false;
        }
        
        if( !$this->setSeries($documents, $serie)) {
            return false;
        }
        
        if( !$this->setDate($documents)) {
            return false;
        }
        
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $params = $this->getRequestParamsXml();
        
        $fileCer = $csd['cerContent'];
        $fileKey = $csd['pemContent'];
        
        $xsltString = $this->getXsltStrinOriginal();    
        
        if( !$xsltString) {
            return false;
        }
        
        $numberCertificate = $csd['csd']->number;
        
        if( !$numberCertificate) {
            return false;
        }
        
        $xmlString = $this->generateXmlCfd($documents);
        
        $idFileCfdBeforeSeal = $this->saveCfdBeforeSeal($documents, $xmlString);
        
        if( !$idFileCfdBeforeSeal) {
            return $this->error('Imposible guardar CFD antes de ser sellado');
        }
        
        $sealXml = $this->getSealXml($xmlString, $xsltString, $fileKey, $fileCer, $numberCertificate);
        
        if( !$sealXml) {
            return false;
        }
        
        $sealXmlString = $this->cleanString($sealXml->saveXML());
        
        $idFileCfdSeal = $this->saveCfdSeal($documents, $sealXmlString);
        
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
        
        $idFileHtmlInvoice = $this->createHtmlInvoice($documents, $dataBell);
        
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
        
        $idFilePdfInvoice = $this->saveFilePdf($documents, $stringPdf);
        
        if( !$idFilePdfInvoice) {
            return false;
        }
        
        $idInvoice = $this->createInvoice(
            $idFileCfdBeforeSeal,
            $idFileCfdSeal,
            $idFileXmlBell, 
            $idFilePdfInvoice, 
            $dataBell, 
            $documents,
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
    
    public function cleanString($string)
    {
        $string = preg_replace('/\s{2,}/', '', $string);
        return str_replace([ PHP_EOL, '\r', '\t', '\s\s\s\s'], '', $string);
    }
    
    public function getXsltStrinOriginal()
    {
        $filePath = __DIR__ . '/cadenaoriginal_3_2.xslt';
        
        if( !file_exists($filePath)) {
            return $this->error('Imposible leer archivo XSLT para generar cadena original');
        }
        
        $xslt = file_get_contents($filePath);
        
        if( !$xslt) {
            return $this->error('Imposible leer el archivo XSLT para generar cadena original');
        }
        
        return $xslt;
    }
    
    public function setDate(Documents &$documents)
    {
        $carbon = new \Carbon\Carbon('now');
        $formatted = $carbon->toRfc3339String();
        $documents->setDate($formatted);
        return true;
    }
    
    public function setSeries(Documents &$documents, &$serie)
    {
        $documents->setSeries($serie->serie);
        $documents->setFolio($serie->folioCurrent + 1);
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
    
    public function createHtmlInvoice(&$documents, &$dataBell)
    {        
        $data = app(PreviewLogic::class)->init($documents);
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
        $idFileHtmlInvoice = $this->saveHtmlInvoice($documents, $htmlInvoice);
        
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
    
    public function getNameFilesGenerate(&$documents)
    {
        return implode('_', [
            $documents->getSeries(),
            $documents->getFolio(),
            $documents->getReceiver()->getRfc()
        ]);
    }
    
    public function saveHtmlInvoice(&$documents, &$htmlInvoice)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($documents),
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
    
    public function saveCfdSeal(&$documents, &$xmlString)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($documents),
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
    
    public function saveCfdBeforeSeal(&$documents, &$xmlString)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($documents),
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
    
    public function generateXmlCfd(Documents &$documents)
    {
        /* CI use RFC test */
        if( env('CI_ENVIROMENT') === 'sandbox') {
            $documents->getTransmitter()->setRfc(env('CI_RFC_TRANSMITTER'));
        }
        
        $xml = view('layouts/ci/xml', [
            'documents'=>$documents
        ])->render();
        
        return $xml;
//        return $this->cleanString($xml);
    }
    
    public function getFileKey()
    {
//        exec('openssl pkcs8 -inform DER -in ' . __DIR__ . '/CSD_Nerine_HECL831114N48_20131122_110931.key -passin pass:mzgcls01', $result, $code);
//        exec('openssl pkcs8 -inform DER -in ' . __DIR__ . '/Claveprivada_FIEL_HECL831114N48_20130830_070529.key -passin pass:WA2pfXHzUJPXKcPCe7dIJIrh', $result, $code);
        exec('openssl pkcs8 -inform DER -in ' . __DIR__ . '/CSD01_AAA010101AAA.key -passin pass:12345678a', $result, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible obtener el archivo PEM');
        }
        
        return implode(PHP_EOL, $result);
    }
    
    public function getFileCer()
    {
//        return file_get_contents(__DIR__ . '/00001000000301379410.cer');
        return file_get_contents(__DIR__ . '/CSD01_AAA010101AAA.cer');
    }
    
    public function saveFilePdf(&$documents, &$stringPdf)
    {
        $name = implode('_', [
            $this->getNameFilesGenerate($documents),
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
        
        $certificate = base64_encode($fileCer);
        
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
        $params['CFD'] = utf8_encode($params['CFD']);
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
        $documents,
        $serie
    )
    {
        $taxes = array_map(function($tax) {
            return $tax->toArray();
        }, $documents->getTaxes());
        $concepts = array_map(function($concept) {
            return $concept->toArray();
        }, $documents->getConcepts());
        
        $result = $this->repoInvoice->create([
            'idIdentityCreated'=>$this->getIdentity(),
            'idInvoiceStatus'=>InvoiceStatus::NNEW,
            'idSerie'=>$serie->id,
            'idFileXml'=>$idFileXmlBell,
            'idFilePdf'=>$idFilePdfInvoice,
            'idFileCfdSeal'=>$idFileCfdSeal,
            'idFileCfdBeforeSeal'=>$idFileCfdBeforeSeal,
            'rfc'=>$documents->getReceiver()->getRfc(),
            'name'=>$documents->getReceiver()->getBusinessName(),
            'uuid'=>$dataBell['uuid'],
            'folio'=>$documents->getFolio(),
            'serie'=>$documents->getSeries(),
            'date'=>$dataBell['date'],
            'sealCfd'=>$dataBell['sealCfd'],
            'sealSat'=>$dataBell['sealSat'],
            'voucherType'=>$documents->getVoucherType(),
            'methodPayment'=>$documents->getMethodPayment(),
            'expeditionPlace'=>$documents->getExpeditionPlace(),
            'coin'=>$documents->getCoin(),
            'numberCertificateSat'=>$dataBell['numberCertificateSat'],
            'stringOriginal'=>$this->getStringOriginal($dataBell),
            'version'=>$documents->getVersion(),
            'rfcTransmitter'=>$documents->getTransmitter()->getRfc(),
            'nameTransmitter'=>$documents->getTransmitter()->getBusinessName(),
            'receiver'=>json_encode($documents->getReceiver()->toArray()),
            'transmitter'=>json_encode($documents->getTransmitter()->toArray()),
            'concepts'=>json_encode($concepts),
            'taxes'=>json_encode($taxes),
            'total'=>$documents->getTotal(),
            'subTotal'=>$documents->getSubTotal()
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
