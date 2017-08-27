<?php 

namespace App\Billing\Modules\Desktop\Csd;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.csd.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.csd.create'),
                    'filesSelect'=>$this->module('task.drive.files.select.access', false),
                ],
                'wrapper'=>[
                    'title'=>'Agregar certificado de sello digital'
                ],
                'i18n'=>[
                    'success'=>'Certificado de sello digital creado',
                    'btnSave'=>'Agregar certificado de sello digital'
                ]
            ]
        ];        
    }
    
}
