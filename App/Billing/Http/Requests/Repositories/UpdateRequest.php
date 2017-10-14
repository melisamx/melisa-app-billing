<?php

namespace App\Billing\Http\Requests\Repositories;

use App\Billing\Http\Requests\Repositories\CreateRequest;

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
        $rules ['id']= 'required|max:36|xss|exists:billing.repositories,id';        
        return $rules;        
    }
    
}
