<?php

namespace App\Billing\Http\Requests\CustomersBanksAccounts;

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
        'filter'=>'bail|sometimes|json|filter:idCustomer,name',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'name'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
        'idCustomer'=>'nullable|xss|max:36|exists:billing.customers,id',
    ];
    
}
