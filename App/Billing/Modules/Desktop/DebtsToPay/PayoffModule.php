<?php 

namespace App\Billing\Modules\Desktop\DebtsToPay;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PayoffModule extends Outbuildings
{
    
    public $event = 'billing.debtsToPay.payoff.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.debtsToPay.payoff'),
                    'report'=>$this->module('task.billing.debtsToPay.report'),
                    'filesSelect'=>$this->module('task.drive.files.select.access', false),
                ],
                'wrapper'=>[
                    'title'=>'Saldar cuenta por pagar'
                ],
                'i18n'=>[
                    'success'=>'Cuenta saldada',
                    'btnSave'=>'Saldar cuenta por pagar'
                ]
            ]
        ];        
    }
    
}
