<?php

namespace App\Billing\Modules\Desktop\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateModule extends Outbuildings
{
    
    public $event = 'billing.exchangeRates.update.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.exchangeRates.update'),
                    'report'=>$this->module('task.billing.exchangeRates.report'),
                    'coins'=>$this->module('task.billing.coins.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Modificar tipo de cambio'
                ],
                'i18n'=>[
                    'success'=>'Tipo de cambio modificado',
                    'btnSave'=>'Modificar tipo de cambio'
                ]
            ]
        ];
        
    }
    
}
