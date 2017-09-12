<?php

namespace App\Billing\Modules\Desktop\Banks;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.banks.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'banks'=>$this->module('task.billing.banks.paging'),
                    'report'=>$this->module('task.billing.banks.report'),
                    'update'=>$this->module('task.billing.banks.update.access', false),
                    'add'=>$this->module('task.billing.banks.add.access', false),
                    'delete'=>$this->module('task.billing.banks.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Bancos'
                ]
            ]
        ];        
    }
    
}
