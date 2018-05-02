<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxActionsController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'TaxActions\PagingRequest',
        'criteria'=>'TaxActions\PagingCriteria'
    ];
    
}
