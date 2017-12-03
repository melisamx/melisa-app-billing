<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BankAccountsController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'BankAccounts\PagingCriteria',
        'request'=>'BankAccounts\PagingRequest',
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
    ];
    
}
