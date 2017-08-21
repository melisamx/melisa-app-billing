<?php

namespace App\Billing\Http\Requests\AccountsReceivable;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ChargedRequest extends Generic
{
    
    protected $rules = [
        'id'=>'required|xss|size:36|exists:billing.accountsReceivable,id',
    ];
    
}
