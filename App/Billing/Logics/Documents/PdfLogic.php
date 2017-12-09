<?php

namespace App\Billing\Logics\Documents;

use App\Drive\Logics\Files\ViewLogic;
use App\Billing\Logics\Documents\ReportLogic;
use App\Billing\Logics\Documents\GeneratePdfLogic;
use App\Billing\Repositories\DocumentsRepository;

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
        $documents = $this->getDocument($id);
        
        if( !$documents) {
            return $this->error('Imposible obtener la información del documento');
        }
        
        $idFile = $this->getFileId($documents);
        
        if( $idFile) {
            return $this->getFileInfo($idFile);
        }
        
        $idFileNew = $this->generateFile($documents);
        
        if( !$this->updateInvoice($idFileNew, $documents->id)) {
            return false;
        }
        
        return $this->getFileInfo($idFileNew);
    }
    
    public function getFileId(&$documents)
    {
        if( $documents->idFilePdf) {
            return $documents->idFilePdf;
        }
        
        return false;
    }
    
    public function generateFile(&$documents)
    {
        $idFile = app(GeneratePdfLogic::class)->init($documents);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo PDF de la factura {i}', [
                'i'=>$documents->id
            ]);
        }
        
        return $idFile;
    }
    
    public function updateInvoice($idFile, $idInvoice)
    {
        $result = app(DocumentsRepository::class)->update([
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
    
    public function getDocument($id)
    {
        return $this->reportLogic->init($id);
    }
    
}
