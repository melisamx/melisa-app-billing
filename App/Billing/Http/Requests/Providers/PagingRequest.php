<?php

namespace App\Billing\Http\Requests\Providers;

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
        'filter'=>'bail|sometimes|json|filter:slug,name,active,idCustomer',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'idCustomer'=>'nullable|xss',
        'slug'=>'nullable|max:75|xss',
        'name'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
