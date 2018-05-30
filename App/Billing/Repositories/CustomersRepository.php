<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class CustomersRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\Customers';        
    }
    
    public function getByIdContributorAddress($idContributorAddress)
    {
        return $this->getModel()
            ->byIdContributorAddress($idContributorAddress)
            ->first();
    }
    
}
