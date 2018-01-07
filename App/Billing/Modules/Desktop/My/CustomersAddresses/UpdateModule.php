<?php

namespace App\Billing\Modules\Desktop\My\CustomersAddresses;

use App\Billing\Modules\Desktop\CustomersAddresses\UpdateModule as BaseUpdateModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends BaseUpdateModule
{
    
    public $event = 'billing.my.customersAddresses.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.my.customersAddresses.update'),
                    'report'=>$this->module('task.billing.my.customersAddresses.report'),
                ]),
                'wrapper'=>[
                    'title'=>'Modificar dirección de cliente'
                ],
                'i18n'=>[
                    'success'=>'Dirección de cliente modificado',
                    'btnSave'=>'Modificar dirección de cliente'
                ],
            ]
        ];
        
    }
    
}
