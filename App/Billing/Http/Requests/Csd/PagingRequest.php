<?php

namespace App\Billing\Http\Requests\Csd;

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
        'filter'=>'bail|sometimes|json|filter:number,name',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'number'=>'nullable|max:150|xss',
        'name'=>'nullable|max:150|xss',
    ];
    
}
