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
        'name'=>'bail|required|xss|max:200',
        'active'=>'bail|required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
