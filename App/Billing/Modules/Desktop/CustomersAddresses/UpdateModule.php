<?php

namespace App\Billing\Modules\Desktop\CustomersAddresses;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends AddModule
{
    
    public $event = 'billing.customersAddresses.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.customersAddresses.update'),
                    'report'=>$this->module('task.billing.customersAddresses.report'),
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
