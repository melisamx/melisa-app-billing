<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\TaxRetentionAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxRetention extends TaxRetentionAbstract
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
