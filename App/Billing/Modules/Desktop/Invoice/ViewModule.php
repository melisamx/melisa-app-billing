<?php

namespace App\Billing\Modules\Desktop\Documents;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.documents.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'documents'=>$this->module('task.billing.documents.paging'),
                    'report'=>$this->module('task.billing.documents.report'),
                    'cancel'=>$this->module('task.billing.documents.cancel', false),
                    'delete'=>$this->module('task.billing.documents.delete', false),
                    'cfdi'=>$this->module('task.billing.cfdi.create', false),
                    'accountReceivable'=>$this->module('task.billing.accountsReceivable.create', false),
                    'debtsToPay'=>$this->module('task.billing.debtsToPay.create', false),
                    'filesView'=>[
                        'pdf'=>$this->module('task.billing.documents.pdf'),
                        'xml'=>$this->module('task.billing.documents.xml'),
                    ]
                ],
                'wrapper'=>[
                    'title'=>'Facturas'
                ]
            ]
        ];        
    }
    
}
