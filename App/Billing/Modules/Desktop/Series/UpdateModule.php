<?php

namespace App\Billing\Modules\Desktop\Series;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends AddModule
{
    
    public $event = 'billing.series.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.series.update'),
                    'report'=>$this->module('task.billing.series.report'),
                ]),
                'wrapper'=>[
                    'title'=>'Modificar serie'
                ],
                'i18n'=>[
                    'success'=>'Serie modificada',
                    'btnSave'=>'Modificar serie'
                ]
            ]
        ];        
    }
    
}
