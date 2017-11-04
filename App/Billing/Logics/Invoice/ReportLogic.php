<?php

namespace App\Billing\Logics\Invoice;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;

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
        InvoiceRepository $repoInvoice
    )
    {
        $this->repoInvoice = $repoInvoice;
    }
    
    public function init($id)
    {
        $record = $this->repoInvoice
            ->with([
                'status',
                'serie',
                'voucherType',
                'transmitter',
                'paymentMethod',
                'wayTopay',
                'concepts',
                'transmitterAddress'=>function($query) {
                    $query->with([
                        'country',
                        'state',
                        'municipality',
                    ]);
                },
                'customer',
                'customerAddress'=>function($query) {
                    $query->with([
                        'country',
                        'state',
                        'municipality',
                    ]);
                },
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        return json_decode(json_encode($record->toArray()));
    }
    
}
