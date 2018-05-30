<?php

namespace App\Billing\Http\Requests\Reports;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BillsPaidRequest extends WithFilter
{
    protected $rules = [
        'page'=>'bail|required|xss|numeric',
        'start'=>'bail|required|xss|numeric',
        'limit'=>'bail|required|xss|numeric',
        'filter'=>'bail|sometimes|json|filter:name,rfc',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'name'=>'nullable|max:150|xss',
        'rfc'=>'nullable|max:150|xss',
    ];
    
}
