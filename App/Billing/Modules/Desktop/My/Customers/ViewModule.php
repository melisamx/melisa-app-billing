<?php

namespace App\Billing\Modules\Desktop\My\Customers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.my.customers.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'customers'=>$this->module('task.billing.my.customers.paging'),
                    'report'=>$this->module('task.billing.my.customers.report'),
                    'update'=>$this->module('task.billing.my.customers.update.access', false),
                    'add'=>$this->module('task.billing.my.customers.add.access', false),
                    'delete'=>$this->module('task.billing.my.customers.delete', false),
                    'addresses'=>$this->module('task.billing.my.customersAddresses.paging'),
                    'addressesAdd'=>$this->module('task.billing.my.customersAddresses.add.access', false),
                    'addressesUpdate'=>$this->module('task.billing.my.customersAddresses.update.access', false),
                    'addressesDelete'=>$this->module('task.billing.my.customersAddresses.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Mis razones sociales'
                ]
            ]
        ];        
    }
    
}
