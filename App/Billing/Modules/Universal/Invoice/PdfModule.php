<?php

namespace App\Billing\Modules\Universal\Documents;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PdfModule extends Outbuildings
{

    public function dataDictionary()
    {        
        $input = $this->getInput();
        
        if( !$input) {
            return false;
        }
        
        return [
            'pageTitle'=>'Previsualizar factura',
            'assets'=>[
                'header'=>$this->asset([
                    'bootstrap.reports',
                    'bootstrap.reports.print',
                    'fontawesome',
                    'insurance.report',
                    'billing.documents.preview',
                ]),
                'powerbyImage'=>$this->asset('powerby.image')
            ],
            'report'=>$input
        ];        
    }
    
}
