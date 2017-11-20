<?php

namespace App\Billing\Logics\Invoice;

use App\Billing\Logics\Invoice\PdfLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Logics\Invoice\GenerateXmlLogic;

/**
 * Get or generate file XML
 *
 * @author Luis Josafat Heredia Contreras
 */
class XmlLogic extends PdfLogic
{
    
    public function getFileId(&$invoice)
    {
        if( $invoice->idFileXml) {
            return $invoice->idFileXml;
        }
        
        return false;
    }
    
    public function generateFile(&$invoice)
    {
        $idFile = app(GenerateXmlLogic::class)->init($invoice);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo XML de la factura {i}', [
                'i'=>$invoice->id
            ]);
        }
        
        return $idFile;
    }
    
    public function updateInvoice($idFile, $idInvoice)
    {
        $result = app(InvoiceRepository::class)->update([
            'idFileXml'=>$idFile
        ], $idInvoice);
        
        if( $result === false) {
            return $this->error('Imposible asociar el archivo XML a la factura {i}', [
                'i'=>$idInvoice
            ]);
        }
        
        return true;
    }
    
}
