<?php

namespace App\Billing\Modules\Desktop\BankAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.bankAccounts.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'bankAccounts'=>$this->module('task.billing.bankAccounts.paging'),
                    'report'=>$this->module('task.billing.bankAccounts.report'),
                    'update'=>$this->module('task.billing.bankAccounts.update.access', false),
                    'add'=>$this->module('task.billing.bankAccounts.add.access', false),
                    'delete'=>$this->module('task.billing.bankAccounts.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Cuentas bancarias'
                ]
            ]
        ];        
    }
    
}
