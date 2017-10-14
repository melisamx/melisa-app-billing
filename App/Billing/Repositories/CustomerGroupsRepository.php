<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class CustomerGroupsRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\CustomerGroups';        
    }
    
}
