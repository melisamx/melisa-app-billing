<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BanksController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'Banks\PagingCriteria',
        'request'=>'Banks\PagingRequest',
    ];
    
}
