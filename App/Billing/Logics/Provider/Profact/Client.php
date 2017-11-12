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
        ];
        
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            $params ['rfcEmisor']= 'AAA010101AAA';
        }
        
        return array_merge($params, $extraParams);
    }
    
    public function getWsdl()
    {
        if(env('PROFACT_ENVIROMENT') === 'sandbox') {
            return env('PROFACT_SERVER_SANDBOX');
        }
        
        return env('PROFACT_SERVER_PRODUCTION');
    }
    
    public function runRequestCancel(&$client, $method, $params = [])
    {
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            return [
                'messageResult'=>'ok'
            ];
        }
        
        try {
            $result = $client->__soapCall($method, [
                'parameters'=>$params
            ]);
        } catch (\SoapFault $fault) {
            return $this->error(utf8_decode($fault->faultcode."-".$fault->faultstring));
        }
        
        if( $result->CancelaCFDIResult->anyType[1] !== '0') {
            return $this->error($result->CancelaCFDIResult->anyType[2]);
        }
        
        return [
            'messageResult'=>$result->CancelaCFDIResult->anyType[2],
            'xml'=>$result->CancelaCFDIResult->anyType[3],
            'qr'=>$result->CancelaCFDIResult->anyType[4],
            'stringOriginal'=>$result->CancelaCFDIResult->anyType[5],
        ];
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
            return $this->error($result->TimbraCFDIResult->anyType[2]);
        }
        
        return [
            'messageResult'=>$result->TimbraCFDIResult->anyType[2],
            'xml'=>$xmlTimbrado,
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
