<?php

namespace App\Billing\Modules\Desktop\CustomerGroups;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.customerGroups.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'customerGroups'=>$this->module('task.billing.customerGroups.paging'),
                    'report'=>$this->module('task.billing.customerGroups.report'),
                    'update'=>$this->module('task.billing.customerGroups.update.access', false),
                    'add'=>$this->module('task.billing.customerGroups.add.access', false),
                    'delete'=>$this->module('task.billing.customerGroups.delete', false),
                    'customers'=>$this->module('task.billing.customerGroupsCustomers.paging'),
                    'identities'=>$this->module('task.billing.customerGroupsIdentities.paging'),
                    'customersAdd'=>$this->module('task.billing.customerGroupsCustomers.add.access', false),
                    'customersDelete'=>$this->module('task.billing.customerGroupsCustomers.delete', false),
                    'identitiesAdd'=>$this->module('task.billing.customerGroupsIdentities.add.access', false),
                    'identitiesDelete'=>$this->module('task.billing.customerGroupsIdentities.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Grupos de clientes'
                ]
            ]
        ];        
    }
    
}
