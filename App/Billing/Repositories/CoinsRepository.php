<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class CoinsRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\Coins';        
    }
    
    public function getByShortName($key)
    {
        return $this->getModel()->byShortName($key)->first();
    }
    
}
