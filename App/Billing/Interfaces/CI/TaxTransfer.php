<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\TaxTransferAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxTransfer extends TaxTransferAbstract
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
