<?php

namespace App\Billing\Modules\Desktop\Repositories;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.repositories.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.repositories.update'),
                    'report'=>$this->module('task.billing.repositories.report'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar cliente base'
                ],
                'i18n'=>[
                    'success'=>'Cliente base modificado',
                    'btnSave'=>'Modificar cliente base'
                ]
            ]
        ];        
    }
    
}
