<?php

namespace App\Billing\Logics\Documents;

use App\Drive\Logics\Files\StringCreateLogic;
use App\Drive\Interfaces\FileContent;
use App\Billing\Modules\Universal\Documents\ReportModule;

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
    
    public function init($documents)
    {
        $xmlString = $this->getXmlString($documents);
        $idFileXml = $this->saveXml($xmlString, $documents);
        
        if( !$idFileXml) {
            return $this->error('Imposible guardar XML de la factura {i}', [
                'i'=>$documents->id,
            ]);
        }
        
        return $idFileXml;
    }
    
    public function getXmlString(&$documents)
    {
        $data = unserialize(base64_decode($documents->cfdiResult));
        return $data['xml'];
    }
    
    public function saveXml(&$string, &$documents)
    {
        $name = implode('_', [
            'invoice_',
            $documents->uuid
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
