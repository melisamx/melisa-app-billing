<?php

namespace App\Billing\Http\Requests\Banks;

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
        'filter'=>'bail|sometimes|json|filter:key,shortname,name,active',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'key'=>'nullable|max:3|xss',
        'shortname'=>'nullable|max:75|xss',
        'name'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
