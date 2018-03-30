<?php

namespace App\Billing\Modules\Desktop\Series;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.series.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>$this->getModules(),
                'wrapper'=>[
                    'title'=>'Series'
                ]
            ]
        ];        
    }
    
    public function getModules()
    {
        return [
            'series'=>$this->module('task.billing.series.paging'),
            'report'=>$this->module('task.billing.series.report'),
            'update'=>$this->module('task.billing.series.update.access', false),
            'add'=>$this->module('task.billing.series.add.access', false),
            'delete'=>$this->module('task.billing.series.delete', false),
        ];
    }
    
}
