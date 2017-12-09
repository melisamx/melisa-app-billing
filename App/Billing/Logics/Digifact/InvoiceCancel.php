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
 * Documents cancel
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceCancel
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
    
    public function init($documents)
    {        
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $params = $this->getRequestParams($documents);
        
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
    
    public function cancelCfdi(&$client, &$params)
    {
        $params ['uuid']= 'CB1C1059-7B9F-11E7-86FB-00155D014300';
        $result = $this->runRequest($client, 'CancelaCFDI', $params);
        dd($result);
        if( !$result) {
            return $this->error('Imposible cancelar la factura');
        }
        
        return $result['CancelaCFDIResult'];
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
        
    public function getRequestParams(&$documents)
    {
        return [
            'Usuario'=>$this->getUser(),
            'Contrasena'=>$this->getPass(),
            'uuid'=>$documents->uuid
        ];
    }    
    
}
