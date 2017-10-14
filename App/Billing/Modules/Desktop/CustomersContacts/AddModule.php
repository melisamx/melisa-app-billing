<?php 

namespace App\Billing\Modules\Desktop\CustomersContacts;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.customersContacts.add.access';
    
    public function dataDictionary()
    {
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.customersContacts.create'),
                    'contacts'=>$this->module('task.people.contacts.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Asociar contacto al cliente'
                ],
                'i18n'=>[
                    'success'=>'Contacto creado',
                    'btnSave'=>'Asociar contacto(s) al cliente'
                ]
            ]
        ];        
    }
    
}
