<?php

namespace App\Billing\Logics\Digifact;

/**
 * Create client and get data default
 *
 * @author Luis Josafat Heredia Contreras
 */
trait Client
{
    
    public function createClient()
    {
        $client = new \nusoap_client($this->getServer(), 'wsdl');
        $error = $client->getError();
        
        if( $error) {
            return $this->error('Error al crear cliente para concetar con Digifact');
        }
        
        return $client;
    }
    
    public function runRequest($client, $method, $params = [])
    {
        try {
            $result = $client->call($method, $params);
        } catch (Exception $ex) {
            return $this->error(utf8_decode($ex->getMessage()));
        }
        
        if( $client->fault) {            
            return $this->error(utf8_decode($client->getError()));
        }
        
        return $result;
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
