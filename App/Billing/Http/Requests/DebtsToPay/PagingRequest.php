<?php

namespace App\Billing\Http\Requests\DebtsToPay;

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
        'filter'=>'bail|sometimes|json|filter:active,account',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'account'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}