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
            'email'=>isset($input['email']) ? $input['email'] : null,
        ], $input['idContributor']);
        
        if( $result === false) {
            return $this->error('Imposible modificar contribuyente');
        }
        
        if( !$this->saveAddress($input['idContributor'], $input)) {
            return false;
        }
        
        return $input['idContributor'];
    }
    
    public function saveAddress($idContributor, $input)
    {
        if( !isset($input['idCountry']) || !isset($input['idAddress'])) {
            return true;
        }
        
        if( !$this->repoAddresses->getModel()
            ->where([
                'idContributor'=>$idContributor,
                'id'=>$input['idAddress'],
            ])
            ->update([
                'idIdentityUpdated'=>$input['idIdentityUpdated'],
                'idCountry'=>$input['idCountry'],
                'idState'=>$input['idState'],
                'idMunicipality'=>$input['idMunicipality'],
                'address'=>$input['address'],
                'colony'=>$input['colony'],
                'postalCode'=>$input['postalCode'],
                'exteriorNumber'=>$input['exteriorNumber'],
                'isDefault'=>isset($input['isDefault']) ? $input['isDefault'] : true,
                'interiorNumber'=>$input['interiorNumber']
            ])) {
            return false;
        }
        
        return true;
    }
    
    public function inyectIdentity(&$input)
    {
        if( !isset($input ['idIdentityUpdated'])) {
            $input ['idIdentityUpdated']= $this->getIdentity();
        }
    }
    
}
