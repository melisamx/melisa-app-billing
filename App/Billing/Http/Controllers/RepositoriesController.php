<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class RepositoriesController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'Repositories\PagingCriteria',
        'request'=>'Repositories\PagingRequest',
    ];
    
}
