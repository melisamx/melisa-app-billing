<?php

namespace App\Billing\Http\Requests\Repositories;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingRequest extends WithFilter
{
    protected $rules = [
        'page'=>'required|xss|numeric',
        'start'=>'required|xss|numeric',
        'limit'=>'required|xss|numeric',
        'filter'=>'sometimes|json|filter:name,active',
        'query'=>'sometimes',
    ];
    
    public $rulesFilters = [
        'name'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
