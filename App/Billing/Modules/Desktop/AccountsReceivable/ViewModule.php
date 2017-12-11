<?php

namespace App\Billing\Modules\Desktop\AccountsReceivable;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.accountsReceivable.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'assets'=>[
                $this->asset('app.billing.accountsReceivable.view')
            ],
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'accountsReceivable'=>$this->module('task.billing.accountsReceivable.paging'),
                    'report'=>$this->module('task.billing.accountsReceivable.report'),
                    'add'=>$this->module('task.billing.accountsReceivable.add.access', false),
                    'charged'=>$this->module('task.billing.accountsReceivable.payoff', false),
                ],
                'wrapper'=>[
                    'title'=>'Cuentas por cobrar'
                ]
            ]
        ];        
    }
    
}
