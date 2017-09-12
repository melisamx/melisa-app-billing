<?php

namespace App\Billing\Http\Requests\Banks;

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
        'key'=>'bail|required|xss|max:3',
        'shortname'=>'bail|required|xss|max:75',
        'name'=>'bail|required|xss|max:200',
        'active'=>'bail|required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
