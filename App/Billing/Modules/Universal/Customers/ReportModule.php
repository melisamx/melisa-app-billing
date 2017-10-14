<?php

namespace App\Billing\Modules\Universal\Customers;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportModule extends Outbuildings
{
    
    public $layout = 'layouts.customers.report';

    public function dataDictionary()
    {        
        $input = $this->getInput();        
        if( !$input) {
            return false;
        }
        
        return [
            'pageTitle'=>'Cliente :: ' . $input->id,
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
