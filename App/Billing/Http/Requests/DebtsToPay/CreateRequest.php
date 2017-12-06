<?php

namespace App\Billing\Http\Requests\DebtsToPay;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    
    protected $rules = [
        'idInvoice'=>'required|xss|size:36|exists:billing.invoice,id',
    ];
    
}
