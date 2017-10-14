<?php 

namespace App\Billing\Modules\Desktop\Repositories;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.repositories.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.repositories.create'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cliente base'
                ],
                'i18n'=>[
                    'success'=>'Cliente base creado',
                    'btnSave'=>'Agregar cliente base'
                ]
            ]
        ];        
    }
    
}
