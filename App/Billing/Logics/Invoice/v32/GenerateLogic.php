<?php

namespace App\Billing\Logics\Invoice\v32;

use App\Billing\Interfaces\Invoice\v32\Invoice;

/**
 * Invoice generate version 3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateLogic
{
    
    public function init(Invoice $invoice)
    {
        $pac = $this->getPac();
        
        $result = $this->getInvoicePac($pac, $invoice);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getInvoicePac($pac, $invoice)
    {
        return app('App\Billing\Logics\\' . $pac . '\InvoiceGenerate')->init($invoice);
    }
    
    public function getPac()
    {
        return env('PAC');
    }
    
}
