<?php

namespace App\Billing\Modules\Universal\ExchangeRates;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportModule extends Outbuildings
{
    
    public $layout = 'layouts.exchangeRates.report';

    public function dataDictionary()
    {        
        $input = $this->getInput();        
        if( !$input) {
            return false;
        }
        
        return [
            'pageTitle'=>'Tipo de cambio :: ' . $input->coin->name,
            'assets'=>[
                'header'=>$this->asset([
                    'bootstrap.reports',
                    'bootstrap.reports.print',
                    'fontawesome',
                ])
            ],
            'report'=>$input
        ];
        
    }
    
}
