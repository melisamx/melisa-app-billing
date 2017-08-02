<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceController extends CrudController
{    
    
    protected $create = [
        'logic'=>'CreateLogic'
    ];
    
    protected $update = [
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'request'=>'Invoice\PagingRequest',
        'criteria'=>'Invoice\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Invoice\ReportModule',
    ];
    
}
