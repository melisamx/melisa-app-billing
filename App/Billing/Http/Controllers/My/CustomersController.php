<?php

namespace App\Billing\Http\Controllers\My;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersController extends CrudController
{
    
    protected $create = [
        'repository'=>'CustomersRepository',
        'request'=>'My\Customers\CreateRequest',
        'logic'=>'CreateLogic'
    ];
    
    protected $update = [
        'repository'=>'CustomersRepository',
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'repository'=>'CustomersRepository',
        'criteria'=>'Customers\PagingCriteria'
    ];
    
    protected $report = [
        'repository'=>'CustomersRepository',
        'logic'=>'ReportLogic',
        'module'=>'Universal\My\Customers\ReportModule',
    ];
    
    protected $delete = [
        'repository'=>'CustomersRepository',
    ];
    
}
