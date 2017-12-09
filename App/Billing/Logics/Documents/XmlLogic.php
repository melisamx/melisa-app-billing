<?php

namespace App\Billing\Logics\Documents;

use App\Billing\Logics\Documents\PdfLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Logics\Documents\GenerateXmlLogic;

/**
 * Get or generate file XML
 *
 * @author Luis Josafat Heredia Contreras
 */
class XmlLogic extends PdfLogic
{
    
    public function getFileId(&$documents)
    {
        if( $documents->idFileXml) {
            return $documents->idFileXml;
        }
        
        return false;
    }
    
    public function generateFile(&$documents)
    {
        $idFile = app(GenerateXmlLogic::class)->init($documents);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo XML de la factura {i}', [
                'i'=>$documents->id
            ]);
        }
        
        return $idFile;
    }
    
    public function updateInvoice($idFile, $idDocument)
    {
        $result = app(DocumentsRepository::class)->update([
            'idFileXml'=>$idFile
        ], $idDocument);
        
        if( $result === false) {
            return $this->error('Imposible asociar el archivo XML a la factura {i}', [
                'i'=>$idDocument
            ]);
        }
        
        return true;
    }
    
}
