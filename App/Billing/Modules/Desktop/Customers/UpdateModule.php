<?php

namespace App\Billing\Modules\Desktop\Customers;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends AddModule
{
    
    public $event = 'billing.customers.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.customers.update'),
                    'report'=>$this->module('task.billing.customers.report'),
                ]),
                'wrapper'=>[
                    'title'=>'Modificar cliente'
                ],
                'i18n'=>[
                    'success'=>'Cliente modificado',
                    'btnSave'=>'Modificar cliente'
                ],
                'fieldsHidden'=>[
                    'id',
                    'idContributor'
                ]
            ]
        ];
        
    }
    
}
