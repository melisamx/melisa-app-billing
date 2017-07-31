<?php

namespace App\Billing\Logics\Digifact;

use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Interfaces\Digifact\v32\Invoice as InvoicePac;

/**
 * Invoice generate
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    
    public function init(Invoice $invoice)
    {
        $invoicePac = new InvoicePac($invoice);
        $formatInvoice = $invoicePac->format();
        
        $client = new \nusoap_client($this->getServer(), 'wsdl');
        $error = $client->getError();
        
        if( $error) {
            dd('error create client');
            return false;
        }
        
        $params = $this->getRequestParams($formatInvoice);
        $result = $this->createRequest('GeneraCFD', $client, $params);
    }
    
    public function createRequest($method, &$client, $params)
    {
        dd($params);
        $result = $client->call($method, $params);
        
        if($client->fault) {
            dd('client fault');
        }
        
        
    }
    
    public function getRequestParams(&$formatInvoice)
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
