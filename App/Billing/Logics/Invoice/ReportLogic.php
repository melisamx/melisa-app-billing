<?php

namespace App\Billing\Logics\Invoice;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Modules\Universal\Invoice\ReportModule;
use App\Billing\Libraries\NumberToLetterConverter;

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
    
    public function init($id, $format = 'html')
    {
        $invoice = $this->repoInvoice->with([
            'status'
        ])->findOrFail($id);
        
        return $this->renderModule($invoice);
    }
    
    public function renderModule(&$invoice)
    {
        if( !$invoice) {
            dd('error');
        }
        
        $report = $invoice->toArray();
        $report ['transmitter']= json_decode($report['transmitter']);
        $report ['receiver']= json_decode($report['receiver']);
        $report ['concepts']= json_decode($report['concepts']);
        $report ['taxes']= json_decode($report['taxes']);
        $report ['totalLetter']= app(NumberToLetterConverter::class)->convertir($report['total']);
        
        return json_decode(json_encode($report));
    }
    
}
