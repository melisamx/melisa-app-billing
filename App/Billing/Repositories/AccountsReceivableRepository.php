<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;
use App\Billing\Models\AccountsReceivableStatus;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AccountsReceivableRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\AccountsReceivable';        
    }
    
    public function createNew($input)
    {
        $input ['idAccountReceivableStatus']= AccountsReceivableStatus::NNEW;
        return $this->create($input);
    }
    
}
