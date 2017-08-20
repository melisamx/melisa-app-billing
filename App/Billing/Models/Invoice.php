<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Invoice extends InvoiceAbstract
{
    
    protected $casts = [
        'receiver'=>'array',
        'transmitter'=>'array',
        'concepts'=>'array',
        'taxes'=>'array',
        'total'=>'double',
    ];
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\InvoiceStatus', 'id', 'idInvoiceStatus');
    }
    
}
