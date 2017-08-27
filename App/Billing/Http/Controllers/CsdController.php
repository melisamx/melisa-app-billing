<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CsdController extends CrudController
{
    
    protected $paging = [
        'request'=>'Csd\PagingRequest',
        'criteria'=>'Csd\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Csd\ReportModule',
    ];
    
    protected $create = [
        'logic'=>'CreateLogic',
    ];
    
}
