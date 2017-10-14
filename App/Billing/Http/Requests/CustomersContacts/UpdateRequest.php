<?php

namespace App\Billing\Http\Requests\CustomersContacts;

use App\Billing\Http\Requests\Banks\CreateRequest;

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
        $rules ['id']= 'bail|required|max:36|xss|exists:billing.customersContacts,id';        
        return $rules;        
    }
    
}
