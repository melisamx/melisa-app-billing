<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ConceptUnitsController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'ConceptUnits\PagingRequest',
        'criteria'=>'ConceptUnits\PagingCriteria'
    ];
    
}
