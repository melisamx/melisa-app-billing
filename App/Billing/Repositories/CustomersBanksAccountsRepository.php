<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class CustomersBanksAccountsRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\CustomersBanksAccounts';        
    }
    
}
