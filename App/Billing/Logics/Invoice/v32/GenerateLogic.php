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
        
        $invoicePac = $this->getInvoicePac($pac, $invoice);
        dd($invoicePac);
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
