<?php

namespace App\Billing\Http\Requests\CustomersBanksAccounts;

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
        'idCustomer'=>'bail|required|xss|max:36|exists:billing.customers,id',
        'idBank'=>'bail|required|xss|exists:billing.banks,id',
        'idCoin'=>'bail|required|xss|exists:billing.coins,id',
        'account'=>'bail|required|xss|max:150',
        'active'=>'bail|required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
