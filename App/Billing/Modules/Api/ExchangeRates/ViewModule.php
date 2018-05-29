<?php

namespace App\Billing\Modules\Api\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'api.billing.exchangeRates.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'paging'=>$this->module('task.api.billing.exchangeRates.paging'),
                'report'=>$this->module('task.api.billing.exchangeRates.report'),
                'add'=>$this->module('task.api.billing.exchangeRates.add.access', false),
            ]
        ];        
    }
    
}
