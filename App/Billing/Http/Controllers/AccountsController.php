<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountsController extends CrudController
{
    
    protected $create = [
        'request'=>'Accounts\CreateRequest',
    ];
    
    protected $paging = [
        'request'=>'Accounts\PagingRequest',
        'criteria'=>'Accounts\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Accounts\ReportModule',
    ];
    
}
