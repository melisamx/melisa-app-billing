<?php

namespace App\Billing\Interfaces\Digifact;

use App\Billing\Interfaces\ReceiverAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Receiver extends ReceiverAbstract
{
    
    public function format()
    {
        return [
            'RFC'=>$this->rfc,
            'RazonSocial'=>$this->businessName,
            'ResidenciaFiscal'=>$this->taxResidence,
            'NumRegIdTrib'=>$this->taxIdNumber,
            'UsoCfdi'=>$this->useCfdi,
        ];
    }
}
