<?php

namespace App\Billing\Logics\Invoice;

use App\Drive\Logics\Files\StringCreateLogic;
use App\Drive\Interfaces\FileContent;
use App\Billing\Modules\Universal\Invoice\ReportModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateXmlLogic
{
    
    protected $reportModule;
    protected $filesCreate;
    protected $filesReport;

    public function __construct(
        ReportModule $reportModule,
        StringCreateLogic $fileCreate
    )
    {
        $this->reportModule = $reportModule;
        $this->filesCreate = $fileCreate;
    }
    
    public function init($invoice)
    {
        $xmlString = $this->getXmlString($invoice);
        $idFileXml = $this->saveXml($xmlString, $invoice);
        
        if( !$idFileXml) {
            return $this->error('Imposible guardar XML de la factura {i}', [
                'i'=>$invoice->id,
            ]);
        }
        
        return $idFileXml;
    }
    
    public function getXmlString(&$invoice)
    {
        $data = unserialize(base64_decode($invoice->cfdiResult));
        return $data['xml'];
    }
    
    public function saveXml(&$string, &$invoice)
    {
        $name = implode('_', [
            'invoice_',
            $invoice->uuid
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.xml')
            ->setOriginalName($name)
            ->setExtension('xml')
            ->setContent($string);
        
        return $this->filesCreate->init($file);
    }
    
}
