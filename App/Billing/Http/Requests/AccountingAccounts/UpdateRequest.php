<?php

namespace App\Billing\Http\Requests\AccountingAccounts;

use App\Billing\Http\Requests\AccountingAccounts\CreateRequest;

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
        $rules ['id']= 'bail|required|max:36|xss|exists:billing.accountingAccounts,id';        
        return $rules;        
    }
    
}
