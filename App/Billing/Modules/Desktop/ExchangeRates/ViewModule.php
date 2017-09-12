<?php

namespace App\Billing\Modules\Desktop\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.exchangeRates.view.access';

    public function dataDictionary() {
        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'exchangeRates'=>$this->module('task.billing.exchangeRates.paging'),
                    'report'=>$this->module('task.billing.exchangeRates.report'),
                    'update'=>$this->module('task.billing.exchangeRates.update.access', false),
                    'add'=>$this->module('task.billing.exchangeRates.add.access', false),
                    'delete'=>$this->module('task.billing.exchangeRates.delete', false),
                ],
                'wrapper'=>[
                    'title'=>'Tipos de cambio'
                ]
            ]
        ];
        
    }
    
}
