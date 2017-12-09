<?php

namespace App\Billing\Http\Requests\Documents;

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
        'filter'=>'bail|sometimes|json|filter:date,folio,customer,status,uuid',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'status'=>'nullable|xss',
        'uuid'=>'nullable|xss',
        'date'=>'nullable|xss|date',
        'folio'=>'nullable|max:75|xss',
        'rfc'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
