<?php

namespace App\Billing\Logics\Invoice\v32;

use App\Billing\Repositories\InvoiceRepository;

/**
 * Invoice cancel version 3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class CancelLogic
{
    
    protected $repoInvoice;

    public function __construct(
        InvoiceRepository $repoInvoice
    )
    {
        $this->repoInvoice = $repoInvoice;
    }
    
    public function init($idInvoice)
    {
        $invoice = $this->getInvoice($idInvoice);
        
        if( !$invoice) {
            return false;
        }
        
        $pac = $this->getPac();
        $result = $this->cancelInvoicePac($pac, $invoice);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getInvoice($id)
    {
        $invoice = $this->repoInvoice->find($id);
        
        if( !$invoice) {
            return $this->error('Imposible obtener la información de la factura');
        }
        
        return $invoice;
    }
    
    public function cancelInvoicePac($pac, $invoice)
    {
        return app('App\Billing\Logics\\' . $pac . '\InvoiceCancel')->init($invoice);
    }
    
    public function getPac()
    {
        return env('PAC');
    }
    
}
