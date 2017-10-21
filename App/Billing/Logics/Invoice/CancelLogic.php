<?php

namespace App\Billing\Logics\Invoice;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Logics\Provider\Profact\InvoiceCancel;

class CancelLogic
{
    
    protected $repoInvoice;

    public function __construct(
        InvoiceRepository $invoice
    )
    {
        $this->repoInvoice = $invoice;
    }
    
    public function init(array $input)
    {
        $invoice = $this->getInvoice($input['id']);
        
        if( !$invoice) {
            return $this->error('Imposible obtener la factura');
        }
        
        if( !$this->isValidInvoice($invoice)) {
            return false;
        }
        
        return $this->cancelLogic($invoice);
    }
    
    public function cancelLogic(&$invoice)
    {
        switch ($invoice->version)
        {
            default:
                return app(InvoiceCancel::class)->init($invoice);
        }
    }
    
    public function isValidInvoice(&$invoice)
    {
        if( $invoice->idInvoiceStatus === InvoiceStatus::NNEW) {
            return true;
        }
        
        return $this->error('No es posible cancelar la factura, su estatus no es nueva');        
    }
    
    public function getInvoice($idInvoice)
    {
        return $this->repoInvoice->find($idInvoice);
    }
    
}