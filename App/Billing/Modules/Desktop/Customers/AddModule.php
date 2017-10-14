<?php 

namespace App\Billing\Modules\Desktop\Customers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customers.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>$this->getModules(),
                'wrapper'=>[
                    'title'=>'Agregar cliente'
                ],
                'i18n'=>[
                    'success'=>'Cliente creado',
                    'btnSave'=>'Agregar cliente'
                ]
            ]
        ];        
    }
    
    public function getModules()
    {
        return [
            'submit'=>$this->module('task.billing.customers.create'),
            'waytopay'=>$this->module('task.billing.waytopay.paging'),
            'states'=>$this->module('task.people.states.paging'),
            'settlements'=>$this->module('task.people.settlements.paging'),
            'municipalities'=>$this->module('task.people.municipalities.paging'),
            'countries'=>$this->module('task.people.countries.paging'),
            'repositories'=>$this->module('task.billing.repositories.paging'),
            'repositoriesAdd'=>$this->module('task.billing.repositories.add.access', false),
        ];
    }
    
}
