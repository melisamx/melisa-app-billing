<?php

namespace App\Billing\Http\Requests\Repositories;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteRequest extends Generic
{
    
    protected $rules = [
        'id'=>'required|max:36|xss|exists:billing.repositories,id',
    ];
    
}
