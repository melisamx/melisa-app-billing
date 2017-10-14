<?php

namespace App\Billing\Http\Requests\CustomersAddresses;

use App\Billing\Http\Requests\CustomersAddresses\CreateRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateRequest extends CreateRequest
{
    
    /**
     * Reuse input create request
     * @return array
     */
    public function rules()
    {        
        $rules = parent::rules();
        $rules ['id']= 'required|numeric|xss|exists:billing.contributorsAddresses,id';        
        return $rules;        
    }
    
}
