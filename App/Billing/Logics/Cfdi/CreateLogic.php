<?php

namespace App\Billing\Logics\Cfdi;

use App\Billing\Repositories\InvoiceRepository;

/**
 * Create CFDI
 *
 * @author nerine
 */
class CreateLogic
{
    
    protected $repoInvoice;

    public function __construct(
        InvoiceRepository $repoInvoice
    )
    {
        $this->repoInvoice = $repoInvoice;
    }
    
    public function init(array $input)
    {
        if( !$this->updateStatusInvoice($input['idInvoice'])) {
            return false;
        }
        
        
        
    }
    
}
