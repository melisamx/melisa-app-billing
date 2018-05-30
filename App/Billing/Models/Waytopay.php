<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Waytopay extends WaytopayAbstract
{
    
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
    
}
