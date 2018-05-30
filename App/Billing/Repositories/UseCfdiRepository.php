<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class UseCfdiRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\UseCfdi';        
    }
    
    public function getByKey($key)
    {
        return $this->getModel()->byKey($key)->first();
    }
    
}
