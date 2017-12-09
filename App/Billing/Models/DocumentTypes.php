<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentTypes extends DocumentTypesAbstract
{
    
    const INVOICE = 'Factura';
    
    public function scopeInvoice(&$query)
    {
        return $query->where('name', 'Factura');
    }
    
}
