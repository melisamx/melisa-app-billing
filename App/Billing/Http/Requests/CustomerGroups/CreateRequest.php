<?php 

namespace App\Billing\Http\Requests\CustomerGroups;

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
        'name'=>'bail|required|xss',
        'active'=>'bail|sometimes|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
