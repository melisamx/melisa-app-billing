<?php

namespace App\Billing\Modules\Desktop\Invoice;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.invoice.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'invoice'=>$this->module('task.billing.invoice.paging'),
                    'report'=>$this->module('task.billing.invoice.report'),
                    'cancel'=>$this->module('task.billing.invoice.cancel', false),
                    'delete'=>$this->module('task.billing.invoice.delete', false),
                    'cfdi'=>$this->module('task.billing.cfdi.create', false),
                    'filesView'=>$this->module('task.drive.files.view'),
                ],
                'wrapper'=>[
                    'title'=>'Facturas'
                ]
            ]
        ];        
    }
    
}
