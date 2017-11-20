<?php

namespace App\Billing\Logics\Invoice;

use App\Drive\Logics\Files\ViewLogic;
use App\Billing\Logics\Invoice\ReportLogic;
use App\Billing\Logics\Invoice\GeneratePdfLogic;
use App\Billing\Repositories\InvoiceRepository;

/**
 * Get or generate file PDF
 *
 * @author Luis Josafat Heredia Contreras
 */
class PdfLogic
{
    
    protected $reportLogic;
    protected $filesView;

    public function __construct(
        ReportLogic $reportLogic,
        ViewLogic $filesView
    )
    {
        $this->reportLogic = $reportLogic;
        $this->filesView = $filesView;
    }
    
    public function init($id)
    {
        $invoice = $this->getInvoice($id);
        
        if( !$invoice) {
            return $this->error('Imposible obtener la información de la factura');
        }
        
        $idFile = $this->getFileId($invoice);
        
        if( $idFile) {
            return $this->getFileInfo($idFile);
        }
        
        $idFileNew = $this->generateFile($invoice);
        
        if( !$this->updateInvoice($idFileNew, $invoice->id)) {
            return false;
        }
        
        return $this->getFileInfo($idFileNew);
    }
    
    public function getFileId(&$invoice)
    {
        if( $invoice->idFilePdf) {
            return $invoice->idFilePdf;
        }
        
        return false;
    }
    
    public function generateFile(&$invoice)
    {
        $idFile = app(GeneratePdfLogic::class)->init($invoice);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo PDF de la factura {i}', [
                'i'=>$invoice->id
            ]);
        }
        
        return $idFile;
    }
    
    public function updateInvoice($idFile, $idInvoice)
    {
        $result = app(InvoiceRepository::class)->update([
            'idFilePdf'=>$idFile
        ], $idInvoice);
        
        if( $result === false) {
            return $this->error('Imposible asociar el archivo PDF a la factura {i}', [
                'i'=>$idInvoice
            ]);
        }
        
        return true;
    }
    
    public function getFileInfo($idFile)
    {
        return $this->filesView->init($idFile);
    }
    
    public function getInvoice($id)
    {
        return $this->reportLogic->init($id);
    }
    
}
