<?php

namespace App\Billing\Http\Requests\TaxActions;

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
        'filter'=>'nullable|json|filter:name',
        'query'=>'nullable|xss|max:36',
    ];
    
    public $rulesFilters = [
        'name'=>'nullable|max:36|xss',
    ];
    
}
