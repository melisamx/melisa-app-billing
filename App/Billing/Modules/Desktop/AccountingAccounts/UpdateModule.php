<?php

namespace App\Billing\Modules\Desktop\AccountingAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.accountingAccounts.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.accountingAccounts.update'),
                    'report'=>$this->module('task.billing.accountingAccounts.report'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar cuenta contable'
                ],
                'i18n'=>[
                    'success'=>'Cuenta contable modificada',
                    'btnSave'=>'Modificar cuenta contable'
                ]
            ]
        ];        
    }
    
}
