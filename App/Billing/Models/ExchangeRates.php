<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ExchangeRates extends ExchangeRatesAbstract
{
    
    protected $casts = [
        'rate'=>'float',
    ];
    
    public function coin()
    {
        return $this->hasOne('App\Billing\Models\Coins', 'id', 'idCoin');
    }
    
    public function setRateAttribute($value)
    {
        $this->attributes['rate'] = round($value, 2);
    }
    
    public function getRateAttribute($value)
    {
        return round($value, 2);
    }
    
}
