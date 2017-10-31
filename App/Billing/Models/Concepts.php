<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Concepts extends ConceptsAbstract
{
    
    public function key()
    {
        return $this->hasOne('App\Billing\Models\ConceptKeys', 'id', 'idConceptKey');
    }
    
}
