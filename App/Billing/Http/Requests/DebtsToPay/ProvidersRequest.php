<?php

namespace App\Billing\Http\Requests\DebtsToPay;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ProvidersRequest extends Generic
{
    
    protected $rules = [
        'idProvider'=>'required|xss|size:36|exists:billing.providers,id',
        'idFileVoucher'=>'required|xss|size:36|exists:drive.files,id',
        'amountPayable'=>'required',
        'dateVoucher'=>'required',
        'dueDate'=>'required',
    ];
    
}
