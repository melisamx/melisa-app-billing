<?php

namespace App\Billing\Http\Requests\ExchangeRates;

use App\Billing\Http\Requests\ExchangeRates\CreateRequest;

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
        $rules ['id']= 'bail|required|numeric|xss|exists:billing.exchangeRates,id';        
        return $rules;        
    }
    
}
