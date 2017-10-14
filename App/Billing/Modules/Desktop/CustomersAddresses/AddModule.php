<?php 

namespace App\Billing\Modules\Desktop\CustomersAddresses;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customersAddresses.add.access';
    
    public function dataDictionary()
    {
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>$this->getModules(),
                'wrapper'=>[
                    'title'=>'Agregar direción al cliente'
                ],
                'i18n'=>[
                    'success'=>'Dirección agregada al cliente',
                    'btnSave'=>'Agregar dirección al cliente'
                ]
            ]
        ];        
    }
    
    public function getModules()
    {
        return [
            'submit'=>$this->module('task.billing.customersAddresses.create'),
            'countries'=>$this->module('task.people.countries.paging'),
            'states'=>$this->module('task.people.states.paging'),
            'municipalities'=>$this->module('task.people.municipalities.paging'),
            'settlements'=>$this->module('task.people.settlements.paging'),
        ];
    }
    
}
