<?php

namespace App\Billing\Http\Requests\Repositories;

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
        'name'=>'required|xss|max:200',
        'active'=>'required|xss|boolean',
        'expirationDays'=>'required|xss|numeric',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
