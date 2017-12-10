<?php 

namespace App\Billing\Http\Requests\Customers;

use Melisa\Laravel\Http\Requests\Generic;
use Melisa\Sanitizes\BeforeSanitize;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    use BeforeSanitize;
    
    protected $rules = [
        'idRepository'=>'required|xss|exists:billing.repositories,id',
        'idWaytopay'=>'required|xss|numeric|exists:billing.waytopay,id',
        'name'=>'required|xss',
        'rfc'=>'required|xss',
        'email'=>'nullable|email|xss',
        'active'=>'required|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
