<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TaxesRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\Taxes';        
    }
    
    public function getByName($key)
    {
        return $this->getModel()->byName($key)->first();
    }
    
}
