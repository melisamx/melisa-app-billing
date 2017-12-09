<?php

namespace App\Billing\Logics\Digifact;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Documents\v32\Documents;
use App\Billing\Interfaces\Digifact\v32\Documents as InvoicePac;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Documents\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;

/* fake */
require_once base_path() . '../../../nusoap/nusoap.php';

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

    public function __construct(
        InvoiceRepository $repoInvoice,
        InvoiceXmlReader $readerXml,
        StringCreateLogic $logicFile
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->readerXml = $readerXml;
        $this->logicFile = $logicFile;
    }
    
    public function init(Documents $documents)
    {
        $invoicePac = new InvoicePac($documents);
        $formatInvoice = $invoicePac->format();
        
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $params = $this->getRequestParamsXml($formatInvoice);
        $xmlString = $this->generateXml($client, $params);
        
        if( !$xmlString) {
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
        
        $idInvoice = $this->createInvoice($idFileXml, $dataXml, $documents);
        
        if( !$idInvoice) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();
        
        $params = $this->getRequestParamsPdf($dataXml);
        $pdfString = $this->generatePdf($client, $params);
        
        if( !$pdfString) {
            return false;
        }
        
        $this->repoInvoice->beginTransaction();
        
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
    
    public function saveFilePdf(&$pdfString, &$xmlData)
    {
        $file = new FileContent();
        $file
            ->setName($xmlData['uuid'] . '.pdf')
            ->setOriginalName($xmlData['uuid'])
            ->setExtension('pdf')
            ->setContent(base64_decode($pdfString));
        
        return $this->logicFile->init($file);
    }
    
    public function saveFileXml(&$xmlBase64, &$xmlData)
    {
        $file = new FileContent();
        $file
            ->setName($xmlData['uuid'] . '.xml')
            ->setOriginalName($xmlData['uuid'])
            ->setExtension('xml')
            ->setContent($xmlBase64);
        
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
        $result = $this->runRequest($client, 'GeneraCFD', $params);
        
        if( !$result) {
            return $this->error('Imposible generar XML con Digifact');
        }
        
        return $result['GeneraCFDResult'];
    }
    
    public function createInvoice($idFileXml, &$dataXml, &$documents)
    {        
        return $this->repoInvoice->create([
            'idIdentityCreated'=>$this->getIdentity(),
            'idInvoiceStatus'=>InvoiceStatus::NNEW,
            'idFileXml'=>$idFileXml,
            'idFilePdf'=>$idFileXml,
            'rfc'=>$documents->getReceiver()->getRfc(),
            'name'=>$documents->getReceiver()->getBusinessName(),
            'uuid'=>$dataXml['uuid'],
            'folio'=>$dataXml['folio'],
            'serie'=>$dataXml['serie'],
            'date'=>$dataXml['date'],
        ]);
    }
    
    public function getXmlData(&$xml)
    {
        return $this->readerXml->init($xml);
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
    
    public function getRequestParamsXml(&$formatInvoice)
    {
        $formatInvoice ['Usuario']= $this->getUser();
        $formatInvoice ['Contrasena']= $this->getPass();
        $formatInvoice ['XMLAddenda']= '';
        return $formatInvoice;
    }
    
}
