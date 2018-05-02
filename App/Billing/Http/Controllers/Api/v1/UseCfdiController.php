<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\ApiCrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UseCfdiController extends ApiCrudController
{
    
    protected $paging = [
        'request'=>'UseCfdi\PagingRequest',
        'criteria'=>'UseCfdi\PagingCriteria'
    ];
    
}
