<?php 

namespace App\Billing\Http\Requests\AccountsReceivable;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AutoRegisterRequest extends Generic
{
    
    protected $rules = [
        'idDocument'=>'required|xss|exists:billing.documents,id',
    ];
    
}
