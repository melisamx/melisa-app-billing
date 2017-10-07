<?php

namespace App\Billing\Logics\Provider\Ci;

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
            return $this->error('Error al crear cliente para concetar con CI');
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
        return env('CI_USER');
    }
    
    public function getPass()
    {
        return env('CI_PASSWORD');
    }
    
    public function getServer()
    {
        return env('CI_SERVER_SANDBOX');
    }
    
}
