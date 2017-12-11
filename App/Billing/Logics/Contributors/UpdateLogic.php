<?php

namespace App\Billing\Logics\Contributors;

use App\Billing\Logics\Contributors\CreateLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $eventSuccess = 'billing.contributors.update.success';
    
    public function create(&$input)
    {
        $result = $this->repository->update([
            'rfc'=>$input['rfc'],
            'name'=>$input['name'],
            'active'=>$input['active'],
            'idIdentityUpdated'=>$input['idIdentityUpdated'],
            'email'=>$input['email'],
        ], $input['idContributor']);
        
        if( $result === false) {
            return $this->error('Imposible modificar contribuyente');
        }
        
        return $input['idContributor'];
    }
    
    public function inyectIdentity(&$input)
    {
        if( !isset($input ['idIdentityUpdated'])) {
            $input ['idIdentityUpdated']= $this->getIdentity();
        }
    }
    
}
