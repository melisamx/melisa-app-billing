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
        'idInvoice'=>'required|xss|exists:billing.invoice,id',
    ];
    
}
