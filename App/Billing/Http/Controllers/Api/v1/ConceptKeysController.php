<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ConceptKeysController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'ConceptKeys\PagingRequest',
        'criteria'=>'ConceptKeys\PagingCriteria'
    ];
    
}
