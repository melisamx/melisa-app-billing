<?php

namespace App\Billing\Http\Requests\Providers\CommissionAgent;

use App\Billing\Http\Requests\Providers\CommissionAgent\CreateRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateRequest extends CreateRequest
{
    
    public function rules()
    {        
        $rules = parent::rules();
        $rules ['id']= 'required|max:36|xss|exists:billing.providers,id';
        return $rules;        
    }
    
}
