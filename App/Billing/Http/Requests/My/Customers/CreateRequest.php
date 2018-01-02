<?php 

namespace App\Billing\Http\Requests\My\Customers;

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
        'idWaytopay'=>'required|xss|numeric|exists:billing.waytopay,id',
        'idCountry'=>'required|xss|exists:people.countries,id',
        'idState'=>'required|xss|exists:people.states,id',
        'idMunicipality'=>'required|xss|exists:people.municipalities,id',
        'name'=>'required|xss',
        'rfc'=>'required|xss',
        'email'=>'nullable|email|xss',
        'active'=>'required|xss|boolean',
        'postalCode'=>'required|numeric|xss',
        'rfc'=>'required|xss|max:13',
        'name'=>'required|xss|max:95',
        'beneficiaryAditional'=>'nullable|xss|max:75',
        'colony'=>'required|xss|max:150',
        'address'=>'required|xss|max:250',
        'email'=>'nullable|xss|email|max:95',
        'active'=>'nullable|xss|boolean',
        'interiorNumber'=>'nullable|xss',
        'exteriorNumber'=>'required|xss',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean'
    ];
    
}
