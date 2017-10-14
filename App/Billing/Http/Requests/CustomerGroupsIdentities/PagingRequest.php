<?php

namespace App\Billing\Http\Requests\CustomerGroupsIdentities;

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
        'filter'=>'bail|sometimes|json|filter:idCustomerGroup,displayEspecific',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'idCustomerGroup'=>'required|xss|max:36|exists:billing.customerGroups,id',
        'displayEspecific'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
