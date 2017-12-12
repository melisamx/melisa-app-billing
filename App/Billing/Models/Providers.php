<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Providers extends ProvidersAbstract
{    
    
    public function type()
    {
        return $this->hasOne('App\Billing\Models\TypesProviders', 'id', 'idTypeProvider');
    }
    
}
