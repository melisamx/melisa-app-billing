<?php 

namespace App\Billing\Modules\Desktop\CustomerGroups;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customerGroups.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customerGroups.create'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar grupo de cliente'
                ],
                'i18n'=>[
                    'success'=>'Grupo de cliente creado',
                    'btnSave'=>'Agregar grupo de cliente'
                ]
            ]
        ];        
    }
    
}
