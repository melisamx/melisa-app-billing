<?php

namespace App\Billing\Http\Requests\DebtsToPay;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PayoffRequest extends Generic
{
    
    protected $rules = [
        'id'=>'required|xss|size:36|exists:billing.debtsToPay,id',
        'idFilePayment'=>'nullable|xss|size:36|exists:drive.files,id',
        'paymentDate'=>'required|xss|date',
    ];
    
}
