<?php

namespace App\Billing\Http\Requests\Series;

use App\Billing\Http\Requests\Series\CreateRequest;

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
        $rules ['id']= 'required|max:36|xss|exists:billing.series,id';
        return $rules;        
    }
    
}
