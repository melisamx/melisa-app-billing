<?php

namespace App\Billing\Modules\Desktop\Repositories;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.repositories.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'repositories'=>$this->module('task.billing.repositories.paging'),
                    'report'=>$this->module('task.billing.repositories.report'),
                    'update'=>$this->module('task.billing.repositories.update.access', false),
                    'add'=>$this->module('task.billing.repositories.add.access', false),
                    'delete'=>$this->module('task.billing.repositories.delete', false),
                    'activate'=>$this->module('task.billing.repositories.activate', false),
                    'deactivate'=>$this->module('task.billing.repositories.deactivate', false),
                ],
                'wrapper'=>[
                    'title'=>'Clientes base'
                ]
            ]
        ];        
    }
    
}
