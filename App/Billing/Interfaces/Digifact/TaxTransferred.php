<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\TaxTransferredAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxTransferred extends TaxTransferredAbstract
{
    
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
