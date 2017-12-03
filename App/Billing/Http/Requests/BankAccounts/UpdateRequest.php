<?php

namespace App\Billing\Http\Requests\BankAccounts;

use App\Billing\Http\Requests\BankAccounts\CreateRequest;

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
        $rules ['id']= 'bail|required|max:36|xss|exists:billing.bankAccounts,id';        
        return $rules;        
    }
    
}
