<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TypesFactorController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'TypesFactor\PagingRequest',
        'criteria'=>'TypesFactor\PagingCriteria'
    ];
    
}
