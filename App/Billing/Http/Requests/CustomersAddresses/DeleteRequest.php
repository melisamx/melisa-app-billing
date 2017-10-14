<?php

namespace App\Billing\Http\Requests\CustomersAddresses;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteRequest extends Generic
{
    
    protected $rules = [
        'id'=>'required|xss|exists:billing.contributorsAddresses,id',
    ];
    
}
