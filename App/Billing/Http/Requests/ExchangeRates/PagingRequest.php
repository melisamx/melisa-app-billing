<?php

namespace App\Billing\Http\Requests\ExchangeRates;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingRequest extends WithFilter
{
    protected $rules = [
        'page'=>'bail|required|xss|numeric',
        'start'=>'bail|required|xss|numeric',
        'limit'=>'bail|required|xss|numeric',
        'filter'=>'bail|sometimes|json|filter:rate,date',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'rate'=>'sometimes|xss|numeric',
        'date'=>'nullable|date|xss',
    ];
    
}
