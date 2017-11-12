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
    
    protected $eventSuccess = 'billing.invoice.new.success';
    protected $eventError = 'billing.cfdi.error';
    
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
        
        if( !$this->setInvoiceGeneratingCfdi($invoice)) {
            return false;
        }
        
        if( !$this->updateSerie($invoice)) {
            return false;
        }
        
        $uuid = $this->generateCfdi($invoice);
        
        if( !$uuid) {
            return $this->setCfdiError($invoice->id);
        } else {
            return $this->setInvoiceNew($invoice->id, $uuid);
        }
    }
    
    public function setInvoiceGeneratingCfdi(&$invoice)
    {
        $folio = $invoice->serie->folioCurrent + 1;
        $carbon = Carbon::now();
        $dateCfdi = $carbon->format('Y-m-d\TH:i:s');
        $status = InvoiceStatus::generatingCfdi();
        
        $invoice->folio = $folio;
        $invoice->dateCfdi = $dateCfdi;
        
        if( !$this->updateInvoice($invoice->id, [
            'idInvoiceStatus'=>$status->id,
            'folio'=>$folio,
            'dateCfdi'=>$dateCfdi
        ])) {
            return $this->error('Imposible establecer estatus {s} a la factura {i}', [
                's'=>$status->name,
                'i'=>$invoice->id
            ]);
        }
        
        return true;
    }
    
    public function setCfdiError($idInvoice)
    {
        $status = InvoiceStatus::errorGenerateCfdi();
        
        if( !$this->updateInvoice($idInvoice, [
            'idInvoiceStatus'=>$status->id
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $event = [
            'idInvoice'=>$idInvoice,
        ];
        
        if( !$this->emitEvent($this->eventError, $event)) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();
        return false;
    }
    
    public function setInvoiceNew($idInvoice, $uuid)
    {
        $status = InvoiceStatus::newInvoice();
        
        if( !$this->updateInvoice($idInvoice, [
            'idInvoiceStatus'=>$status->id
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $event = [
            'idInvoice'=>$idInvoice,
            'uuid'=>$uuid,
        ];
        
        if( !$this->emitEvent($this->eventSuccess, $event)) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();
        return $event;
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
    
    public function updateInvoice($idInvoice, array $input)
    {
        $result = $this->repoInvoice->update($input, $idInvoice);
        
        if( $result === false) {
            return false;
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
