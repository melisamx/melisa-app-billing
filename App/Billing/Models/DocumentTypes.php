<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentTypes extends DocumentTypesAbstract
{
    
    const INVOICE = 'Factura';
    const NOTE = 'Nota';
    
    public function scopeInvoice(&$query)
    {
        return $query->where('name', 'Factura');
    }
    
    public function scopeNote(&$query)
    {
        return $query->where('name', self::NOTE);
    }
    
}
