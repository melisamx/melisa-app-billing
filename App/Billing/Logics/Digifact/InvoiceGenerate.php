<?php

namespace App\Billing\Logics\Digifact;

use App\Billing\Interfaces\Digifact\Invoice;

/**
 * Invoice generate
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    
    public function init(Invoice $invoice)
    {
        $client = new \nusoap_client($this->getServer(), 'wsdl');
        $error = $client->getError();
        
        if( $error) {
            return false;
        }
        
        $params = $this->getRequestParams($invoice);
        $result = $this->createRequest('GeneraCFDIV33', $client, $params);
    }
    
    public function createRequest($method, &$client, $params)
    {
        $result = $client->call($method, $params);
        dd($result);
    }
    
    public function getRequestParams(&$invoice)
    {
        $request = $invoice->format();
        return [
            'CFDIRequest'=>[
                'Usuario'=>$this->getUser(),
                'Contrasena'=>$this->getPass(),
                'DatosCFDI'=>$request
            ],
        ];
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
