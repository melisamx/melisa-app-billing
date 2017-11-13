<?php

namespace App\Billing\Logics\Invoice;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Logics\Invoice\ReportLogic;
use App\Billing\Models\InvoiceStatus;

/**
 * Delete invoice
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $eventSuccess = 'billing.invoice.delete.success';
    protected $repository;
    protected $logicReport;
    
    public function __construct(
        InvoiceRepository $repository
    )
    {
        parent::__construct($repository);
        $this->logicReport = app(ReportLogic::class);
    }
    
    public function delete(&$input)
    {        
        $invoice = $this->getInvoice($input['id']);
        
        if( !$invoice) {
            return false;
        }
        
        if( !$this->isValid($invoice)) {
            return false;
        }
        
        return parent::delete($input);
    }
    
    public function getInvoice($id)
    {
        $invoice = $this->logicReport->init($id);
        
        if( !$invoice) {
            return $this->error('Imposible obtener reporte de la factura {f}', [
                'f'=>$id
            ]);
        }
        
        return $invoice;
    }
    
    public function isValid(&$invoice)
    {
        if( $invoice->status->key === InvoiceStatus::PENDING_GENERATE_CFDI) {
            return true;
        }
        
        return false;
    }
    
}
