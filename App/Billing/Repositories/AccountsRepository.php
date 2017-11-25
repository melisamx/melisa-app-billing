<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AccountsRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\Accounts';        
    }
    
    public function getDefaultInvoice()
    {
        return $this->findWhere([
            'key'=>'invoice'
        ])->first();
    }
}
