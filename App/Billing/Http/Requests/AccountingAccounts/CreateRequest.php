<?php

namespace App\Billing\Http\Requests\AccountingAccounts;

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
        'name'=>'required|xss|max:150',
        'expirationDays'=>'required|xss|numeric',
        'groupingCode'=>'nullable|xss',
        'active'=>'required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
