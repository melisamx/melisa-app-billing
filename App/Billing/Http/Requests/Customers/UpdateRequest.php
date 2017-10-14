<?php

namespace App\Billing\Http\Requests\Customers;

use App\Billing\Http\Requests\Customers\CreateRequest;

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
        $rules ['id']= 'required|max:36|xss|exists:billing.customers,id';        
        $rules ['idContributor']= 'required|max:36|xss|exists:billing.contributors,id';        
        return $rules;        
    }
    
}
