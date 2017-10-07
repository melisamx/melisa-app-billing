<?php

namespace App\Billing\Logics\Provider\Profact;

/**
 * Create client and get data default
 *
 * @author Luis Josafat Heredia Contreras
 */
trait Client
{

    public function createClient($params)
    {
        $ws = $this->getWsdl();
        return new \SoapClient($ws, $params);        
    }
    
    public function getClientParams($extraParams)
    {
        $params = [
            'usuarioIntegrador'=>env('PROFACT_USER'),
            'idComprobante'=>rand(5, 999999)
        ];
        return array_merge($params, $extraParams);
    }
    
    public function getWsdl()
    {
        if(env('PROFACT_ENVIROMENT') === 'sandbox') {
            return env('PROFACT_SERVER_SANDBOX');
        }
        
        return env('PROFACT_SERVER_PRODUCTION');
    }
    
    public function runRequest(&$client, $method, $params = [])
    {
        try {
            $result = $client->__soapCall($method, $params);
        } catch (\SoapFault $fault) {
            return $this->error(utf8_decode($fault->faultcode."-".$fault->faultstring));
        }
        
        $xmlTimbrado = $result->TimbraCFDIResult->anyType[3];
        
        if( empty($xmlTimbrado)) {
            return false;
        }
        
        return [
            'messageResult'=>$result->TimbraCFDIResult->anyType[2],
            'xml'=>$xmlTimbrado,
            'qr'=>$result->TimbraCFDIResult->anyType[4],
            'stringOriginal'=>$result->TimbraCFDIResult->anyType[5],
        ];
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
