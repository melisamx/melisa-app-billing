<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TaxActions extends TaxActionsAbstract
{
    
    public function getByKey($key)
    {
        return $this
            ->where([
                'key'=>$key
            ])
            ->first();
    }
    
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
    
}
