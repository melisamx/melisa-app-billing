<?php 

namespace App\Billing\Http\Requests\Waytopay;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingRequest extends WithFilter
{
    protected $rules = [
        'page'=>'bail|required|xss|numeric',
        'start'=>'bail|required|xss|numeric',
        'limit'=>'bail|required|xss|numeric',
        'query'=>'bail|sometimes|xss',
        'filter'=>'bail|sometimes|json|filter:name',
    ];
    
    public $rulesFilters = [
        'name'=>'bail|sometimes|max:36|xss',
    ];
    
}
