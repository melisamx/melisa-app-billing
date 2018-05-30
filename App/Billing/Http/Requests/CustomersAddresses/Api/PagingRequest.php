<?php

namespace App\Billing\Http\Requests\CustomersAddresses\Api;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingRequest extends WithFilter
{
    protected $rules = [
        'id'=>'required|xss|max:36|exists:billing.customers,id',
        'page'=>'required|xss|numeric',
        'start'=>'required|xss|numeric',
        'limit'=>'required|xss|numeric',
        'filter'=>'sometimes|json|filter:idContributor,country,state,municipality',
        'query'=>'nullable',
    ];
    
    public $rulesFilters = [
        'country'=>'nullable|max:150|xss',
        'state'=>'nullable|max:150|xss',
        'municipality'=>'nullable|max:150|xss',
        'active'=>'nullable|xss|boolean',
        'idContributor'=>'nullable|xss|max:36|exists:billing.contributors,id',
    ];
    
    public function validationData()
    {
        $this->merge([
            'id'=>$this->route('id')
        ]);
        return parent::validationData();
    }
    
}
