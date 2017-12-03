<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountingAccountsController extends CrudController
{
    
    protected $create = [
        'request'=>'AccountingAccounts\CreateRequest',
    ];
    
    protected $paging = [
        'request'=>'AccountingAccounts\PagingRequest',
        'criteria'=>'AccountingAccounts\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
    ];
    
}
