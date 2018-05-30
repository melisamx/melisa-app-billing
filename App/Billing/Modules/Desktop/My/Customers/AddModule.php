<?php 

namespace App\Billing\Modules\Desktop\My\Customers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.my.customers.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>$this->getModules(),
                'wrapper'=>[
                    'title'=>'Agregar razón social'
                ],
                'i18n'=>[
                    'success'=>'Razón social creada',
                    'btnSave'=>'Agregar razón social'
                ]
            ]
        ];        
    }
    
    public function getModules()
    {
        return [
            'submit'=>$this->module('task.billing.my.customers.create'),
            'waytopay'=>$this->module('task.billing.waytopay.paging'),
            'states'=>$this->module('task.people.states.paging'),
            'settlements'=>$this->module('task.people.settlements.paging'),
            'municipalities'=>$this->module('task.people.municipalities.paging'),
            'countries'=>$this->module('task.people.countries.paging'),
        ];
    }
    
}
