<?php 

namespace App\Billing\Http\Requests\Series;

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
        'serie'=>'required|xss',
        'folioInitial'=>'required|xss|numeric',
        'isDefault'=>'sometimes|xss|boolean',
        'active'=>'sometimes|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
