<?php

namespace App\Billing\Modules\Desktop\DebtsToPay;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.debtsToPay.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'debtsToPay'=>$this->module('task.billing.debtsToPay.paging'),
                    'report'=>$this->module('task.billing.debtsToPay.report'),
                    'add'=>$this->module('task.billing.debtsToPay.add.access', false),
                    'payoff'=>$this->module('task.billing.debtsToPay.payoff', false),
                ],
                'wrapper'=>[
                    'title'=>'Cuentas por pagar'
                ]
            ]
        ];        
    }
    
}
