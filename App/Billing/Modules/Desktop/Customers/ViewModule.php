<?php

namespace App\Billing\Modules\Desktop\Customers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.customers.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'customers'=>$this->module('task.billing.customers.paging'),
                    'report'=>$this->module('task.billing.customers.report'),
                    'update'=>$this->module('task.billing.customers.update.access', false),
                    'add'=>$this->module('task.billing.customers.add.access', false),
                    'delete'=>$this->module('task.billing.customers.delete', false),
                    'activate'=>$this->module('task.billing.customers.activate', false),
                    'deactivate'=>$this->module('task.billing.customers.deactivate', false),
                    'contactsAdd'=>$this->module('task.billing.customersContacts.add.access', false),
                    'contacts'=>$this->module('task.billing.customersContacts.paging'),
                    'addresses'=>$this->module('task.billing.customersAddresses.paging'),
                    'contactsDelete'=>$this->module('task.billing.customersContacts.delete', false),
                    'addressesDelete'=>$this->module('task.billing.customersAddresses.delete', false),
                    'addressesActivate'=>$this->module('task.billing.customersAddresses.activate', false),
                    'addressesDeactivate'=>$this->module('task.billing.customersAddresses.deactivate', false),
                    'banksAccountsAdd'=>$this->module('task.billing.customersBanksAccounts.add.access', false),
                    'banksAccounts'=>$this->module('task.billing.customersBanksAccounts.paging'),
                    'banksAccountsDelete'=>$this->module('task.billing.customersBanksAccounts.delete', false),
                    'banksAccountsActivate'=>$this->module('task.billing.customersBanksAccounts.activate', false),
                    'banksAccountsDeactivate'=>$this->module('task.billing.customersBanksAccounts.deactivate', false),
                ],
                'wrapper'=>[
                    'title'=>'Clientes'
                ]
            ]
        ];        
    }
    
}
