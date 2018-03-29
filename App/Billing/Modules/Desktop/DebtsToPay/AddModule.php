<?php 

namespace App\Billing\Modules\Desktop\DebtsToPay;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.debtsToPay.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.debtsToPay.create'),
                    'filesSelect'=>$this->module('task.drive.files.select.access', false),
                    'providers'=>$this->module('task.billing.providers.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cuenta por pagar'
                ],
                'i18n'=>[
                    'success'=>'Cuenta por pagar creada',
                    'btnSave'=>'Agregar cuenta por pagar'
                ]
            ]
        ];        
    }
    
}
