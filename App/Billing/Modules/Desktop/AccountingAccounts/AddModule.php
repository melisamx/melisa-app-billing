<?php 

namespace App\Billing\Modules\Desktop\AccountingAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.accountingAccounts.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.accountingAccounts.create'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cuenta contable'
                ],
                'i18n'=>[
                    'success'=>'Cuenta contable creada',
                    'btnSave'=>'Agregar cuenta contable'
                ]
            ]
        ];        
    }
    
}
