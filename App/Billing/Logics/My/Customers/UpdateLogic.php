<?php

namespace App\Billing\Logics\My\Customers;

use App\Billing\Logics\Customers\UpdateLogic as BaseUpdateLogic;
use App\Billing\Logics\Repositories\IdentitiesPrivilegeTrait;

/**
 * Update customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends BaseUpdateLogic
{    
    use IdentitiesPrivilegeTrait;
    
    protected $eventSuccess = 'billing.my.customers.update.success';
    
    public function isValidCustomer(&$input)
    {
        $repositories = $this->getRepositoriesPrivilege();
        
        if( !$repositories) {
            return false;
        }
        
        if( !count($repositories)) {
            return $this->error('No se le ha asignado un cliente base, no es posible registrar el beneficiario');
        }
        
        $input ['idRepository']= $repositories[0];
        
        return parent::isValidCustomer($input);
    }
        
    public function createCustomer($idContributor, &$input)
    {
        $repositories = $this->getRepositoriesPrivilege();
        
        if( !$repositories) {
            return false;
        }
        
        if( !count($repositories)) {
            return $this->error('No se le ha asignado un cliente base, no es posible registrar el beneficiario');
        }
        
        $input ['idRepository']= $repositories[0];
        
        return parent::createCustomer($idContributor, $input);
    }
    
}
