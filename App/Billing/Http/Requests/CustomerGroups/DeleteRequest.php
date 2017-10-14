<?php

namespace App\Billing\Http\Requests\Customers;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteRequest extends Generic
{
    
    protected $rules = [
        'id'=>'bail|required|xss|exists:billing.customers,id',
    ];
    
}
