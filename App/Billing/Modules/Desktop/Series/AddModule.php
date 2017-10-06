<?php 

namespace App\Billing\Modules\Desktop\Series;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.series.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>$this->getModules(),
                'wrapper'=>[
                    'title'=>'Agregar serie'
                ],
                'i18n'=>[
                    'success'=>'Serie creada',
                    'btnSave'=>'Agregar serie'
                ]
            ]
        ];        
    }
    
    public function getModules()
    {
        return [
            'submit'=>$this->module('task.billing.series.create'),
        ];
    }
    
}
