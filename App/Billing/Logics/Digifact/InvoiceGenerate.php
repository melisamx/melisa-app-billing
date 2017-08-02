<?php

namespace App\Billing\Logics\Digifact;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Interfaces\Digifact\v32\Invoice as InvoicePac;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Invoice\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;

/* fake */
require_once base_path() . '../../../nusoap/nusoap.php';

/**
 * Invoice generate
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    use LogicBusiness;
    
    protected $repoInvoice;
    protected $readerXml;

    public function __construct(
        InvoiceRepository $repoInvoice,
        InvoiceXmlReader $readerXml
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->readerXml = $readerXml;
    }
    
    public function init(Invoice $invoice)
    {
        $invoicePac = new InvoicePac($invoice);
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
        
        $idInvoice = $this->createInvoice($xmlString, $dataXml);
        
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
        
        if( !$this->updateInvoice($idInvoice, [
            'pdf'=>$pdfString
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();        
        return $idInvoice;
    }
    
    public function updateInvoice($idInvoice, $data)
    {
        return $this->repoInvoice->update($data, $idInvoice);
    }
    
    public function generatePdf($client, $params)
    {
        $result = $client->call('GeneraPDF', $params);
        
        if( $client->fault) {
            $this->error('Imposible generar PDF con Digifact');
        }
        
        return $result['GeneraPDFResult'];
    }
    
    public function createClient()
    {
        $client = new \nusoap_client($this->getServer(), 'wsdl');
        $error = $client->getError();
        
        if( $error) {
            return $this->error('Error al crear cliente para concetar con Digifact');
        }
        
        return $client;
    }
    
    public function generateXml(&$client, $params)
    {
        $result = $client->call('GeneraCFD', $params);
        
        if( $client->fault) {
            $this->error('Imposible conectar con Digifact');
        }
        
        return $result['GeneraCFDResult'];
    }
    
    public function createInvoice(&$xmlString, &$dataXml)
    {        
        return $this->repoInvoice->create([
            'idIdentityCreated'=>$this->getIdentity(),
            'idInvoiceStatus'=>InvoiceStatus::NNEW,
            'xml'=>$xmlString,
            'pdf'=>'',
            'uuid'=>$dataXml['uuid'],
            'folio'=>$dataXml['folio'],
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
    
    public function getUser()
    {
        return env('DIGIFACT_USER');
    }
    
    public function getPass()
    {
        return env('DIGIFACT_PASSWORD');
    }
    
    public function getServer()
    {
        return env('DIGIFACT_SERVER_SANDBOX');
    }
    
}
