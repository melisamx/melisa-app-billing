<?php

namespace App\Billing\Modules\Desktop\Banks;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.banks.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.banks.update'),
                    'report'=>$this->module('task.billing.banks.report'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar banco'
                ],
                'i18n'=>[
                    'success'=>'Banco modificado'
                ]
            ]
        ];        
    }
    
}
