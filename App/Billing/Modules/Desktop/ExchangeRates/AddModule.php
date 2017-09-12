<?php 

namespace App\Billing\Modules\Desktop\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddModule extends Outbuildings
{
    
    public $event = 'billing.exchangeRates.add.access';
    
    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'submit'=>$this->module('task.billing.exchangeRates.create'),
                    'coins'=>$this->module('task.billing.coins.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Agregar tipo de cambio'
                ],
                'i18n'=>[
                    'success'=>'Tipo de cambio creado',
                    'btnSave'=>'Agregar tipo de cambio'
                ]
            ]
        ];        
    }
    
}
