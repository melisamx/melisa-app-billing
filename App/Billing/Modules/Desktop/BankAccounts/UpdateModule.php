<?php

namespace App\Billing\Modules\Desktop\BankAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.bankAccounts.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.bankAccounts.update'),
                    'report'=>$this->module('task.billing.bankAccounts.report'),
                    'banks'=>$this->module('task.billing.banks.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar cuenta bancaria'
                ],
                'i18n'=>[
                    'success'=>'Cuenta bancaria modificada',
                    'btnSave'=>'Modificar cuenta bancaria'
                ]
            ]
        ];        
    }
    
}
