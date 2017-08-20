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
                'modules'=>[
                    'series'=>$this->module('task.billing.series.paging'),
                    'report'=>$this->module('task.billing.series.report'),
                ],
                'wrapper'=>[
                    'title'=>'Series'
                ]
            ]
        ];        
    }
    
}
