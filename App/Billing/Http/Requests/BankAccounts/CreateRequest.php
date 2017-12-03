<?php

namespace App\Billing\Http\Requests\BankAccounts;

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
        'idBank'=>'required|xss|numeric|exists:billing.banks,id',
        'beginningBalance'=>'required|xss|numeric',
        'accountNumber'=>'required|xss|max:20',
        'name'=>'required|xss|max:75',
        'active'=>'required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
