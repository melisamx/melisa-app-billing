<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class PaymentMethods extends PaymentMethodsAbstract
{
    const PUE = 'PUE';
    
    public function scopePue()
    {
        return $this->where('key', self::PUE)->first();
    }
    
}
