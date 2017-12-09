<?php

namespace App\Billing\Http\Requests\Documents;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CancelRequest extends WithFilter
{
    protected $rules = [
        'id'=>'bail|required|xss|exists:billing.documents,id',
    ];
    
}
