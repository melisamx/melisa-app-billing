<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ConceptUnits extends ConceptUnitsAbstract
{
    
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
    
}
