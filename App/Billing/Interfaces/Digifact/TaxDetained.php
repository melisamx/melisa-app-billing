<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\TaxDetainedAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxDetained extends TaxDetainedAbstract
{
    
    protected $typeFactor = 'Tasa';

    public function format()
    {
        return [
            'Base'=>$this->base,
            'Importe'=>$this->amount,
            'TipoFactor'=>$this->typeFactor,
            'TasaOCuota'=>$this->taxShare,
            'Impuesto'=>$this->tax,
        ];
    }
    
}
