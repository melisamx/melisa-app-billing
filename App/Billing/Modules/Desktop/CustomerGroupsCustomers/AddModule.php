<?php 

namespace App\Billing\Modules\Desktop\CustomerGroupsCustomers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customerGroupsCustomers.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customerGroupsCustomers.create'),
                    'customers'=>$this->module('task.billing.customers.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cliente a grupo de clientes'
                ],
                'i18n'=>[
                    'success'=>'Cliente agregado al grupo de clientes',
                    'btnSave'=>'Agregar cliente al grupo de clientes'
                ]
            ]
        ];        
    }
    
}
