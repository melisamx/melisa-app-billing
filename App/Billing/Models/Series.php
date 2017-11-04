<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Series extends SeriesAbstract
{
    
    public function scopeDefault()
    {
        return $this
            ->where([
                'isDefault'=>true,
                'active'=>true
            ])
            ->first();
    }
    
}
