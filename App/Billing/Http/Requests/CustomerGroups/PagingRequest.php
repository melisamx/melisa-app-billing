<?php

namespace App\Billing\Http\Requests\Customers;

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
        'filter'=>'bail|sometimes|json|filter:name,rfc,email',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'name'=>'sometimes|max:36|xss',
        'rfc'=>'sometimes|max:20|xss',
        'email'=>'sometimes|xss',
    ];
    
}
