<?php

namespace App\Billing\Logics\Invoice;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Logics\Invoice\v32\ReportLogic as Invoice32Report;

/**
 * Invoice report
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repoInvoice;

    public function __construct(
        InvoiceRepository $invoice
    )
    {
        $this->repoInvoice = $invoice;
    }
    
    public function init($id, $format)
    {
        $invoice = $this->repoInvoice->with([
            'status'
        ])->findOrFail($id);
        dd($id);
        if( !$invoice) {
            return $this->error('Imposible get invoice');
        }
        
        return $this->renderModule($invoice);
    }
    
    public function renderModule(&$invoice)
    {
        $report = $invoice->toArray();
        dd($report);
    }
    
}
