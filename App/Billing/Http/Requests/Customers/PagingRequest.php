<?php

namespace App\Billing\Http\Requests\Customers;

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
        'filter'=>'bail|sometimes|json|filter:name,rfc,email,idRepository,postalCode,address,repository',
        'query'=>'bail|sometimes',
    ];
    
    public $rulesFilters = [
        'name'=>'sometimes|max:36|xss',
        'rfc'=>'sometimes|xss',
        'email'=>'sometimes|xss',
        'postalCode'=>'sometimes|numeric|xss',
        'address'=>'sometimes|xss',
        'repository'=>'sometimes|xss',
        'idRepository'=>'sometimes|xss|size:36|exists:billing.repositories,id',
    ];
    
}
