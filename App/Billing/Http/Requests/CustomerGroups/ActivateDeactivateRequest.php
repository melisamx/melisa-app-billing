<?php

namespace App\Billing\Http\Requests\CustomerGroups;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ActivateDeactivateRequest extends Generic
{
    
    protected $rules = [
        'id'=>'required|size:36|xss|exists:billing.customerGroups,id',
    ];
    
}