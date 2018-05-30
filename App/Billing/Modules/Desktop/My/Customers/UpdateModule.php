<?php

namespace App\Billing\Modules\Desktop\My\Customers;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends AddModule
{
    
    public $event = 'billing.my.customers.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.my.customers.update'),
                    'report'=>$this->module('task.billing.my.customers.report'),
                ]),
                'wrapper'=>[
                    'title'=>'Modificar razón social'
                ],
                'i18n'=>[
                    'success'=>'Razón social modificada',
                    'btnSave'=>'Modificar razón social'
                ],
                'fieldsHidden'=>[
                    'id',
                    'idContributor'
                ]
            ]
        ];
        
    }
    
}
