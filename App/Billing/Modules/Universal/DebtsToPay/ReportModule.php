<?php

namespace App\Billing\Modules\Universal\DebtsToPay;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportModule extends Outbuildings
{
    
    public $layout = 'layouts.debtsToPay.report';

    public function dataDictionary()
    {        
        $input = $this->getInput();
        
        if( !$input) {
            return false;
        }
        
        return [
            'pageTitle'=>'Reporte de cuenta por pagar',
            'assets'=>[
                'header'=>$this->asset([
                    'bootstrap.reports',
                    'bootstrap.reports.print',
                    'fontawesome',
                ]),
                'powerbyImage'=>$this->asset('powerby.image')
            ],
            'modules'=>[
                'filesView'=>$this->module('task.drive.files.view')
            ],
            'report'=>$input
        ];        
    }
    
}
