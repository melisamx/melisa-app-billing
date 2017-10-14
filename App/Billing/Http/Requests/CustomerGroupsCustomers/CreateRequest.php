<?php

namespace App\Billing\Http\Requests\CustomerGroupsCustomers;

use Melisa\Laravel\Http\Requests\Generic;
use Melisa\Sanitizes\BeforeSanitize;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    use BeforeSanitize;
    
    protected $rules = [        
        'idCustomerGroup'=>'bail|required|xss|max:36|exists:billing.customerGroups,id',
        'idCustomer'=>'bail|required|xss|max:36|exists:billing.customers,id',
        'active'=>'bail|required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
