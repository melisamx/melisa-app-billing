<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ProvidersController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'Providers\PagingCriteria',
        'request'=>'Providers\PagingRequest',
    ];
    
}
