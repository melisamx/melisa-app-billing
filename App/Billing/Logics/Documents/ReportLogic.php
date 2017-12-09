<?php

namespace App\Billing\Logics\Documents;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Documents report
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
      
    protected $repoInvoice;
    protected $convertNumber;

    public function __construct(
        InvoiceRepository $repoInvoice
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->convertNumber = new NumberToLetterConverter();
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
                'coin',
                'useCfdi',
                'concepts'=>function($query) {
                    $query->with([
                        'concept',
                        'key',
                        'unit',
                        'taxes'=>function($query) {
                            $query->with([
                                'tax',
                                'action',
                                'typeFactor',
                            ]);
                        }
                    ]);
                },
                'transmitter'=>function($query) {
                    $query->with([
                        'fiscalRegime',
                    ]);
                },
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
                        'accountingAccount',
                    ]);
                },
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $result = json_decode(json_encode($record->toArray()));
        $result->totalLetter = $this->convertNumber->convertir($result->total);
        
        $this->groupTaxes($result);
        
        return $result;
    }
    
    public function groupTaxes(&$result)
    {
        $taxesTransfer = [];
        $taxesRetention = [];
        foreach($result->concepts as $concept) {
            foreach($concept->taxes as $tax) {
                if( $tax->action->key === 't') {
                    $taxesTransfer []= $tax;
                } else {
                    $taxesRetention []= $tax;
                }
            }
        }
        $result->taxes = new \stdClass();
        $result->taxes->transfer = $taxesTransfer;
        $result->taxes->retention = $taxesRetention;
    }
    
}
