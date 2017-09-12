<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Coins extends CoinsAbstract
{
    
    public function exchangerate()
    {
        return $this->hasOne('App\Billing\Models\ExchangeRates', 'idCoin', 'id');
    }
    
}
