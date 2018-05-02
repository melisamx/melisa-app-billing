<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ConceptsController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'Concepts\PagingRequest',
        'criteria'=>'Concepts\PagingCriteria'
    ];
    
}
