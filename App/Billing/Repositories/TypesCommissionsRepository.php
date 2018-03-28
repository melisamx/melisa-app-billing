<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TypesCommissionsRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\TypesCommissions';        
    }
    
    public function getByKey($key)
    {
        return $this->getModel()->where('key', $key)->first();
    }
}
