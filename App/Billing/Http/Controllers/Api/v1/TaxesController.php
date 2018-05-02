<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TaxesController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'Taxes\PagingRequest',
        'criteria'=>'Taxes\PagingCriteria'
    ];
    
}
