<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Invoice extends InvoiceAbstract
{
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\InvoiceStatus', 'id', 'idInvoiceStatus');
    }
    
}
