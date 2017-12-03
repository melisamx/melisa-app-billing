<?php

namespace App\Billing\Http\Requests\BankAccounts;

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
        'filter'=>'sometimes|json|filter:bank,name,groupingCode,active',
        'query'=>'sometimes',
    ];
    
    public $rulesFilters = [
        'groupingCode'=>'nullable|max:75|xss',
        'bank'=>'nullable|max:75|xss',
        'name'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
    ];
    
}
