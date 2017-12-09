<?php

namespace App\Billing\Logics\Documents\v32;

use App\Billing\Repositories\InvoiceRepository;

/**
 * Documents cancel version 3.2
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
        $documents = $this->getInvoice($idInvoice);
        
        if( !$documents) {
            return false;
        }
        
        $pac = $this->getPac();
        $result = $this->cancelInvoicePac($pac, $documents);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getInvoice($id)
    {
        $documents = $this->repoInvoice->find($id);
        
        if( !$documents) {
            return $this->error('Imposible obtener la información de la factura');
        }
        
        return $documents;
    }
    
    public function cancelInvoicePac($pac, $documents)
    {
        return app('App\Billing\Logics\\' . $pac . '\InvoiceCancel')->init($documents);
    }
    
    public function getPac()
    {
        return env('PAC');
    }
    
}
