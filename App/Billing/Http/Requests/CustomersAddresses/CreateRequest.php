<?php 

namespace App\Billing\Http\Requests\CustomersAddresses;

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
        'idContributor'=>'required|numeric|exists:billing.contributors,id',
        'idCountry'=>'required|xss|numeric|exists:people.countries,id',
        'idState'=>'required|xss|numeric|exists:people.states,id',
        'idMunicipality'=>'required|xss|numeric|exists:people.municipalities,id',
        'address'=>'required|xss',
        'colony'=>'required|xss',
        'postalCode'=>'required|xss|numeric',
        'interiorNumber'=>'nullable|xss|numeric',
        'exteriorNumber'=>'required|xss|numeric',
        'active'=>'sometimes|xss|boolean',
        'isDefault'=>'sometimes|xss|boolean',
    ];
    
    protected $sanitizes = [
        'active'=>'boolean',
        'isDefault'=>'boolean',
    ];
    
}
