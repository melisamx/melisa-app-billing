<?php

namespace App\Billing\Http\Requests\CustomersBanksAccounts;

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
        $rules ['id']= 'bail|required|max:36|xss|exists:billing.customersBanksAccounts,id';        
        return $rules;        
    }
    
}
