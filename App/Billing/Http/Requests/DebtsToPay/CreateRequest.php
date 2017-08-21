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
        'idAccount'=>'required|xss|numeric|exists:billing.accounts,id',
        'idFileVoucher'=>'required|xss|max:36|exists:drive.files,id',
        'amountPayable'=>'required|xss|numeric',
        'dateVoucher'=>'required|xss|date',
        'dueDate'=>'required|xss|date',
    ];
    
}
