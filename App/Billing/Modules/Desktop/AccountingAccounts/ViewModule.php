<?php

namespace App\Billing\Modules\Desktop\AccountingAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.accountingAccounts.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'accountingAccounts'=>$this->module('task.billing.accountingAccounts.paging'),
                    'report'=>$this->module('task.billing.accountingAccounts.report'),
                    'update'=>$this->module('task.billing.accountingAccounts.update.access', false),
                    'add'=>$this->module('task.billing.accountingAccounts.add.access', false),
                    'delete'=>$this->module('task.billing.accountingAccounts.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Cuentas contables'
                ]
            ]
        ];        
    }
    
}
