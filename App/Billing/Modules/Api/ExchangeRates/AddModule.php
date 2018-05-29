<?php

namespace App\Billing\Modules\Api\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'api.billing.exchangeRates.add.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'modules'=>[
                    'submit'=>$this->module('task.api.billing.exchangeRates.create'),
                    'coins'=>$this->module('task.api.billing.coins.paging'),
                ]
            ]
        ];
    }
    
}
