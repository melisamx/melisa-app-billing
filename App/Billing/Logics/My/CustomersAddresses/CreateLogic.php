<?php

namespace App\Billing\Logics\My\CustomersAddresses;

use App\Billing\Logics\CustomersAddresses\CreateLogic as BaseCreateLogic;
use App\Billing\Logics\Repositories\IdentitiesPrivilegeTrait;

/**
 * Create customer address
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    use IdentitiesPrivilegeTrait;
    
    protected $eventSuccess = 'billing.my.customersAddresses.create.success';    
    
    public function create(&$input)
    {
        $repositories = $this->getRepositoriesPrivilege();
        
        if( !$repositories) {
            return false;
        }
        
        if( !count($repositories)) {
            return $this->error('No se le ha asignado un cliente base, no es posible registrar el beneficiario');
        }
        
        $input ['idRepository']= $repositories[0];
        
        return parent::create($input);
    }
    
}
