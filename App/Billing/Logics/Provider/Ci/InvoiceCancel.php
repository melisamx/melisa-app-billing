<?php

namespace App\Billing\Logics\CI;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Documents\v32\Documents;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Documents\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Documents cancel
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceCancel
{
    use LogicBusiness, Client;
    
    protected $logicGetContentFile;

    public function __construct(
        GetContentLogic $logicGetContentFile
    )
    {
        $this->logicGetContentFile = $logicGetContentFile;
    }
    
    public function init($documents)
    {
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $cfd = $this->getCfd($documents->idFileXml);
        
        if( !$cfd) {
            return false;
        }
        
        $xmlCancel = $this->getXmlCancel($documents);
        
        $params = $this->getRequestParams();
        $params ['CFD']= $xmlCancel;
        
        $result = $this->cancelCfdi($client, $params);
        dd($result);
        if( !$result) {
            return false;
        }
        
        $this->repoInvoice->beginTransaction();
        
        $dataXml = $this->getXmlData($xmlString);
        
        if( !$dataXml) {
            return false;
        }
        
        $idFileXml = $this->saveFileXml($xmlString, $dataXml);
        
        if( !$idFileXml) {
            return $this->error('Imposible guardar XML de la factura');
        }
        
        $idFilePdf = $this->saveFilePdf($pdfString, $dataXml);
        
        if( !$idFilePdf) {
            return $this->error('Imposible guardar PDF de la factura');
        }
        
        if( !$this->updateInvoice($idInvoice, [
            'idFilePdf'=>$idFilePdf
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();        
        return [
            'idInvoice'=>$idInvoice,
            'idFilePdf'=>$idFilePdf,
            'idFileXml'=>$idFileXml,
        ];
    }
    
    public function getXmlCancel(&$documents)
    {
        $objCancel = new \stdClass();
        $objCancel->uuid = $documents->uuid;
        $objCancel->uuid = $documents->uuid;
        $fileCer = $this->getFileCer();
        $fileKey = str_replace([ '\n', '\r'], '', $this->getFileKey());
        
        $objCancel->certificate = base64_encode($fileCer);
        $objCancel->keyCertificate = base64_encode($fileKey);
        
        /* CI use RFC test */
        if( env('CI_ENVIROMENT') === 'sandbox') {
            $objCancel->rfc = 'CGA030903UC3';//env('CI_RFC_TRANSMITTER');
        } else {
            $objCancel->rfc = $documents->rfcTransmitter;
        }
//        dd($objCancel);
        return str_replace([ PHP_EOL, '\r'], '', view('layouts/ci/cancel', [
            'cancel'=>$objCancel
        ])->render());
    }
    
    public function getFileKey()
    {
        exec('openssl pkcs8 -inform DER -in ' . __DIR__ . '/CSD01_AAA010101AAA.key -passin pass:12345678a', $result, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible obtener el archivo PEM');
        }
//        array_shift($result);
//        array_pop($result);
        return implode(PHP_EOL, $result);
    }
    
    public function getFileCer()
    {
        return file_get_contents(__DIR__ . '/CSD01_AAA010101AAA.cer');
    }
    
    public function getCfd($idFileCfd)
    {
        $content = $this->logicGetContentFile->init($idFileCfd);
        
        if( $content === false) {
            return $this->error('Imposible obtener el contenido del CFD timbrado');
        }
        
        return str_replace([ PHP_EOL, '\r'], '', $content);
    }
    
    public function cancelCfdi(&$client, &$params)
    {
        dd($params);
        $result = $this->runRequest($client, 'CancelarCFDI', $params);
        dd($result);
        if( !$result) {
            return $this->error('Imposible cancelar la factura');
        }
        
        return $result['CancelaCFDIResult'];
    }   
        
    public function getRequestParams()
    {
        return [
            'LoginWS'=>$this->getUser(),
            'PasswordWS'=>$this->getPass(),
        ];
    }    
    
}
