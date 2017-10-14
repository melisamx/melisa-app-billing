<?php

namespace App\Billing\Http\Requests\CustomersAddresses;

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
        'filter'=>'bail|sometimes|json|filter:idContributor,country,state,municipality',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'country'=>'nullable|max:150|xss',
        'state'=>'nullable|max:150|xss',
        'municipality'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
        'idContributor'=>'nullable|xss|max:36|exists:billing.contributors,id',
    ];
    
}
