<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class VoucherTypes extends VoucherTypesAbstract
{
    
    const ENTRY = 'i';
    
    public function scopeEntry()
    {
        return $this->where('key', self::ENTRY)->first();
    }
    
}
