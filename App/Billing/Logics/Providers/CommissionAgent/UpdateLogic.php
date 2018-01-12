<?php

namespace App\Billing\Logics\Providers\CommissionAgent;

use App\Billing\Logics\Providers\CommissionAgent\CreateLogic;

/**
 * Update customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $eventSuccess = 'billing.providers.commissionAgent.update.success';
    protected $fieldIdIdentityCreated = 'idIdentityUpdated';
    
    public function create(&$input)
    {
        $typeProvider = $this->getTypeProvider();
        
        if( !$typeProvider) {
            return false;
        }
        
        $input ['slug']= str_slug($input['name']);
        $input ['idTypeProvider']= $typeProvider->id;
        return $this->repository->update($input, $input['id']);
    }
    
}
