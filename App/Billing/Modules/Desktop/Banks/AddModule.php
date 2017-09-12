<?php 

namespace App\Billing\Modules\Desktop\Banks;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.banks.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.banks.create'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar banco'
                ],
                'i18n'=>[
                    'success'=>'Banco creado',
                    'btnSave'=>'Agregar banco'
                ]
            ]
        ];        
    }
    
}
