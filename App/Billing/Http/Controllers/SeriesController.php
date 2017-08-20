<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class SeriesController extends CrudController
{
    
    protected $paging = [
        'request'=>'Series\PagingRequest',
        'criteria'=>'Series\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Series\ReportModule',
    ];
    
}
