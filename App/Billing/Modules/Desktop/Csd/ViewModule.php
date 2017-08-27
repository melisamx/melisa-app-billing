<?php

namespace App\Billing\Modules\Desktop\Csd;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.csd.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'csd'=>$this->module('task.billing.csd.paging'),
                    'report'=>$this->module('task.billing.csd.report'),
                    'add'=>$this->module('task.billing.csd.add.access', false),
                    'delete'=>$this->module('task.billing.csd.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Certificados de sello digital'
                ]
            ]
        ];        
    }
    
}
