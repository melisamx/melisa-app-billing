<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\ConceptAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Concept extends ConceptAbstract
{
    
    public function format()
    {
        return [
            'ClaveProdServ'=>$this->productOrServiceKey,
            'NoIdentificacion'=>$this->numberIdentification,
            'Cantidad'=>$this->quantity,
            'claveUnidad'=>$this->unitKey,
            'Unidad'=>$this->unit,
            'Descripcion'=>$this->description,
            'ValorUnitario'=>$this->unitValue,
            'Importe'=>$this->amount,
            'Descuento'=>$this->discount,
        ];
    }
}
