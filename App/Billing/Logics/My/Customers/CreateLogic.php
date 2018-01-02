<?php

namespace App\Billing\Logics\My\Customers;

use App\Billing\Logics\Customers\CreateLogic as BaseCreateLogic;
use App\Billing\Logics\Repositories\IdentitiesPrivilegeTrait;

/**
 * Create customer and contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    use IdentitiesPrivilegeTrait;
    
    protected $eventSuccess = 'billing.my.customers.create.success';    
    
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
        
        $id = $this->customers->create([
            'idRepository'=>$input['idRepository'],
            'idContributor'=>$idContributor,
            'active'=>$input['active'],
            'idWaytopay'=>$input['idWaytopay'],
            'idIdentityCreated'=>$input['idIdentityCreated'],
            'expirationDays'=>isset($input['expirationDays']) ? $input['expirationDays'] : null,
        ]);
        
        if( $id) {
            return $id;
        }
        
        return $this->error('Imposible crear cliente');  
    }
    
}
