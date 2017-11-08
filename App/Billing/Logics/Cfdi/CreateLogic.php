<?php

namespace App\Billing\Logics\Cfdi;

use Carbon\Carbon;
use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Logics\Invoice\ReportLogic;
use App\Billing\Logics\Provider\Profact\InvoiceGenerate;

/**
 * Create CFDI
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic
{
    use LogicBusiness;
    
    protected $repoInvoice;
    protected $repoSeries;
    protected $logicReport;
    protected $logicGenerate;

    public function __construct(
        InvoiceRepository $repoInvoice,
        SeriesRepository $repoSeries,
        ReportLogic $logicReport,
        InvoiceGenerate $logicGenerate
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->repoSeries = $repoSeries;
        $this->logicReport = $logicReport;
        $this->logicGenerate = $logicGenerate;
    }
    
    public function init(array $input)
    {
        $this->repoInvoice->beginTransaction();
        
        $invoice = $this->getInvoice($input['id']);
        
        if( !$invoice) {
            return false;
        }
        
        if( !$this->isValid($invoice)) {
            return false;
        }
        
        if( !$this->updateInvoice($invoice)) {
            return false;
        }
        
        if( !$this->updateSerie($invoice)) {
            return false;
        }
        
//        $this->repoInvoice->commit();
        
        return $this->generateCfdi($invoice);
    }
    
    public function updateSerie(&$invoice)
    {
        $result = $this->repoSeries->update([
            'folioCurrent'=>$invoice->folio
        ], $invoice->id);
        
        if( $result === false) {
            return $this->error('Imposible incrementar folio de la serie {s}', [
                's'=>$invoice->serie->name
            ]);
        }
        
        return true;
    }
    
    public function updateInvoice(&$invoice)
    {
        $folio = $invoice->serie->folioCurrent + 1;
        $carbon = Carbon::now();
        $dateCfdi = $carbon->toRfc3339String();
        $status = InvoiceStatus::generatingCfdi();
        
        $invoice->folio = $folio;
        $invoice->dateCfdi = $dateCfdi;
        
        $result = $this->repoInvoice->update([
            'idInvoiceStatus'=>$status->id,
            'folio'=>$folio,
            'dateCfdi'=>$dateCfdi
        ], $invoice->id);
        
        if( $result === false) {
            return $this->error('Imposible actualizar factura {f}', [
                'i'=>$invoice->id,
            ]);
        }
        
        return true;
    }
    
    public function generateCfdi(&$invoice)
    {
        return $this->logicGenerate->init($invoice);
    }
    
    public function getInvoice($id)
    {
        $invoice = $this->logicReport->init($id);
        
        if( !$invoice) {
            return $this->error('Imposible obtener reporte de la factura {f}', [
                'f'=>$input['id']
            ]);
        }
        
        return $invoice;
    }
    
    public function isValid(&$invoice)
    {
        if( $invoice->status->key === InvoiceStatus::PENDING_GENERATE_CFDI) {
            return true;
        }
        
        switch ($invoice->status->key) {
            case InvoiceStatus::GENERATING_CFDI:
                return $this->error('Ya se encuentra generando el CFDI');
                break;

            default:
                $this->error('Imposible generar CFDI');
                break;
        }
    }
    
}
