<?php

namespace App\Billing\Logics\Invoice;

use App\Drive\Logics\Files\StringCreateLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\ReportLogic;
use App\Billing\Modules\Universal\Invoice\ReportModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GeneratePdfLogic
{
    
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
    
    public function init($invoice)
    {
        $html = $this->generateHtml($invoice);
        
        $idFileHtml = $this->saveHtml($html, $invoice);
        
        if( !$idFileHtml) {
            return $this->error('Imposible guardar reporte de factura {i} para transformar en PDF', [
                'i'=>$invoice->uuid
            ]);
        }
        
        $fileHtml = $this->getFileDrive($idFileHtml);
        
        if( !$fileHtml) {
            return $this->error('Imposible obtener el archivo HTML de la factura {u}', [
                'u'=>$invoice->uuid,
            ]);
        }
        
        $stringPdf = $this->generatePdf($fileHtml, $invoice);
        
        if( !$stringPdf) {
            return false;
        }
        
        $idFilePdfInvoice = $this->savePdf($stringPdf, $invoice);
        
        if( !$idFilePdfInvoice) {
            return $this->error('Imposible guardar PDF de la factura {i}', [
                'i'=>$invoice->uuid,
            ]);
        }
        
        return $idFilePdfInvoice;
    }
    
    public function savePdf(&$stringPdf, &$invoice)
    {
        $name = implode('_', [
            'invoice_',
            $invoice->uuid
        ]);
        
        $file = new FileContent();
        $file
            ->setName($name . '.pdf')
            ->setOriginalName($name)
            ->setExtension('pdf')
            ->setContent($stringPdf);
        
        return $this->filesCreate->init($file);
    }
    
    public function generatePdf(&$fileHtml, &$invoice)
    {
        $nameOutput = pathinfo($fileHtml->originalFilename);
        $nameOutput = $fileHtml->unit->source .
            $nameOutput['filename'] . 
            '.pdf';
        
        $command = implode('', [
            'wkhtmltopdf ',
            '-s Letter --encoding "UTF-8" -L 0 -R 0 -T 0 -B 0 "file://',
            $fileHtml->unit->source,
            $fileHtml->originalFilename,
            '" ',
            $nameOutput
        ]);
        
        $output = [];
        exec($command, $output, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible generar factura {u} en formato PDF: {e}', [
                'e'=>explode(PHP_EOL, $output),
                'u'=>$invoice->uuid
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
    
    public function saveHtml(&$html, &$invoice)
    {
        $name = implode('_', [
            $invoice->uuid,
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
    
    public function generateHtml($invoice)
    {
        return $this->reportModule
            ->withInput($invoice)
            ->render()
            ->render();
    }
    
}
