<?php

namespace App\Billing\Modules\Universal\Invoice;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportModule extends Outbuildings
{
    
    public $layout = 'layouts.invoice.preview';

    public function dataDictionary()
    {        
        $input = $this->getInput();
        
        if( !$input) {
            return false;
        }
        
        return [
            'pageTitle'=>'Reporte de factura',
            'assets'=>[
                'header'=>$this->asset([
                    'bootstrap.reports',
                    'bootstrap.reports.print',
                    'fontawesome',
                    'insurance.report',
                    'billing.invoice.preview',
                    'qrcodejs'
                ]),
                'powerbyImage'=>$this->asset('powerby.image')
            ],
            'report'=>$input
        ];        
    }
    
}
