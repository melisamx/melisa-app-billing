<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersBanksAccountsController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'CustomersBanksAccounts\PagingCriteria',
        'request'=>'CustomersBanksAccounts\PagingRequest',
    ];
    
}
