<?php 

namespace App\Billing\Modules\Desktop\CustomersBanksAccounts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customersBanksAccounts.add.access';
    
    public function dataDictionary()
    {
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customersBanksAccounts.create'),
                    'banks'=>$this->module('task.billing.banks.paging'),
                    'coins'=>$this->module('task.billing.coins.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar cuenta bancaria de cliente'
                ],
                'i18n'=>[
                    'success'=>'Cuenta bancaría creada',
                    'btnSave'=>'Agregar cuenta bancaria'
                ]
            ]
        ];        
    }
    
}
