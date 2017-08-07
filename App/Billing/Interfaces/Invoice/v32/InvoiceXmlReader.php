<?php

namespace App\Billing\Interfaces\Invoice\v32;

/**
 * Read invoice xml v3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceXmlReader
{
    
    public function init(&$xmlString)
    {
        $xmlString = str_replace(PHP_EOL, '', utf8_encode($xmlString));
        $xmlString = trim(preg_replace('/\t+/', '', $xmlString));
        $xml = simplexml_load_string($xmlString);
        $data = [];
        $this->normalize($xml, $data);
        preg_match('/UUID=\"(.*?)\"/i', $xmlString, $uuid);
        return [
            'version'=>$data['version'],
            'folio'=>$data['folio'],
            'date'=>$data['fecha'],
            'seal'=>$data['sello'],
            'certificateNumber'=>$data['noCertificado'],
            'certificate'=>$data['certificado'],
            'subTotal'=>$data['subTotal'],
            'total'=>$data['total'],
            'serie'=>$data['serie'],
            'uuid'=>$uuid[1]
        ];
    }    
    
    public function normalize($obj, &$result)
    {        
        $data = $obj;
        if (is_object($data)) {            
            $data = get_object_vars($data);            
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $res = null;
                $this->normalize($value, $res);
                if (($key == '@attributes') && ($key)) {
                    $result = $res;
                } else {
                    $result[$key] = $res;
                }
            }
        } else {
            $result = $data;
        }
    }
    
}
