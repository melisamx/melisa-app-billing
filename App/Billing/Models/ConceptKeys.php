<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ConceptKeys extends ConceptKeysAbstract
{
    
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
    
}
