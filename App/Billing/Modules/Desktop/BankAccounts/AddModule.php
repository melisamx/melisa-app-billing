<?php 

namespace App\Billing\Modules\Desktop\BankAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.bankAccounts.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.bankAccounts.create'),
                    'banks'=>$this->module('task.billing.banks.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cuenta bancaria'
                ],
                'i18n'=>[
                    'success'=>'Cuenta bancaria creada',
                    'btnSave'=>'Agregar cuenta bancaria'
                ]
            ]
        ];        
    }
    
}
