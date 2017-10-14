<?php 

namespace App\Billing\Modules\Desktop\CustomerGroupsIdentities;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customerGroupsIdentities.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customerGroupsIdentities.create'),
                    'identities'=>$this->module('task.security.identities.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar perfil a grupo de clientes'
                ],
                'i18n'=>[
                    'success'=>'Perfil agregado al grupo de clientes',
                    'btnSave'=>'Agregar perfil al grupo de clientes'
                ]
            ]
        ];        
    }
    
}
