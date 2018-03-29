<?php

namespace App\Billing\Logics\Documents;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\ReportLogic;
use App\Billing\Modules\Universal\Documents\ReportModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GeneratePdfLogic
{
    use LogicBusiness;
    
    protected $reportModule;
    protected $filesCreate;
    protected $filesReport;

    public function __construct(
        ReportModule $reportModule,
        StringCreateLogic $fileCreate,
        ReportLogic $filesReport
    )
    {
        $this->reportModule = $reportModule;
        $this->filesCreate = $fileCreate;
        $this->filesReport = $filesReport;
    }
    
    public function init($document)
    {
        $html = $this->generateHtml($document);
        
        $idFileHtml = $this->saveHtml($html, $document);
        
        if( !$idFileHtml) {
            return $this->error('Imposible guardar reporte de factura {i} para transformar en PDF', [
                'i'=>$document->uuid
            ]);
        }
        
        $fileHtml = $this->getFileDrive($idFileHtml);
        
        if( !$fileHtml) {
            return $this->error('Imposible obtener el archivo HTML de la factura {u}', [
                'u'=>$document->uuid,
            ]);
        }
        
        $stringPdf = $this->generatePdf($fileHtml, $document);
        
        if( !$stringPdf) {
            return false;
        }
        
        $idFilePdfInvoice = $this->savePdf($stringPdf, $document);
        
        if( !$idFilePdfInvoice) {
            return $this->error('Imposible guardar PDF de la factura {i}', [
                'i'=>$document->uuid,
            ]);
        }
        
        return $idFilePdfInvoice;
    }
    
    public function savePdf(&$stringPdf, &$documents)
    {
        $name = implode('_', [
            'invoice_',
            $documents->uuid
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.pdf')
            ->setOriginalName($name)
            ->setExtension('pdf')
            ->setContent($stringPdf);
        
        return $this->filesCreate->init($file);
    }
    
    public function generatePdf(&$fileHtml, &$documents)
    {
        $nameOutput = pathinfo($fileHtml->originalFilename);
        $nameOutput = $fileHtml->unit->source .
            $nameOutput['filename'] . 
            '.pdf';
        
        $command = implode('', [
            base_path() . '/htmlToPdf.js ',
//            'wkhtmltopdf ',
//            '-s Letter --encoding "UTF-8" -L 0 -R 0 -T 0 -B 0 "file://',
            $fileHtml->unit->source,
            $fileHtml->originalFilename,
            ' ',
            $nameOutput
        ]);
        
        $output = [];
        exec($command, $output, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible generar factura {u} en formato PDF: {e}', [
                'e'=>implode(PHP_EOL, $output),
                'u'=>$documents->uuid
            ]);
        }
        
        $content = file_get_contents($nameOutput);
        @unlink($nameOutput);
        return $content;
    }
    
    public function getFileDrive($idFile)
    {
        return $this->filesReport->init($idFile);
    }
    
    public function saveHtml(&$html, &$documents)
    {
        $name = implode('_', [
            $documents->uuid,
            'html'
        ]);
        
        $file = app(FileContent::class);
        $file
            ->setName($name . '.html')
            ->setOriginalName($name)
            ->setExtension('html')
            ->setContent($html);
        
        return $this->filesCreate->init($file);
    }
    
    public function generateHtml($document)
    {
        return $this->reportModule
            ->withInput($document)
            ->render()
            ->render();
    }
    
}
