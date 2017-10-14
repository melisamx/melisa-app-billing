<?php

namespace App\Billing\Modules\Desktop\CustomerGroups;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.customerGroups.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customerGroups.update'),
                    'report'=>$this->module('task.billing.customerGroups.report'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar grupo de clientes'
                ],
                'i18n'=>[
                    'success'=>'Grupo de clientes modificado',
                    'btnSave'=>'Modificar grupo de clientes'
                ]
            ]
        ];
        
    }
    
}
