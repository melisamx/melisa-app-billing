<?php 

namespace App\Billing\Modules\Desktop\My\CustomersAddresses;

use App\Billing\Modules\Desktop\CustomersAddresses\AddModule as BaseAddModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends BaseAddModule
{
    
    public $event = 'billing.my.customersAddresses.add.access';
    
    public function dataDictionary()
    {
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>array_merge($this->getModules(), [
                    'submit'=>$this->module('task.billing.my.customersAddresses.create'),
                ]),
                'wrapper'=>[
                    'title'=>'Agregar direción al cliente'
                ],
                'i18n'=>[
                    'success'=>'Dirección agregada al cliente',
                    'btnSave'=>'Agregar dirección al cliente'
                ]
            ]
        ];        
    }
    
}
