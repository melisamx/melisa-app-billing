<?php 

namespace App\Billing\Http\Requests\Cfdi;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    
    protected $rules = [
        'idInvoice'=>'required|xss|exists:billing.invoice,id',
    ];
    
}
