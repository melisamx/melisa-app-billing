<?php 

namespace App\Billing\Http\Requests\ExchangeRates;

use Melisa\Laravel\Http\Requests\Generic;
use Melisa\Sanitizes\BeforeSanitize;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    use BeforeSanitize;
    
    protected $rules = [
        'idCoin'=>'bail|required|xss|numeric|exists:billing.coins,id',
        'date'=>'bail|required|xss|date',
        'rate'=>'bail|required|xss|numeric',
    ];
    
    protected $sanitizes = [];
    
}
