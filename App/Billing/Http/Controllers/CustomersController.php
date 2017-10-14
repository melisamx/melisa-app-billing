<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersController extends CrudController
{
    
    protected $create = [
        'logic'=>'CreateLogic',
        'request'=>'Customers\CreateRequest'
    ];
    
    protected $paging = [
        'request'=>'Customers\PagingRequest',
        'repository'=>'CustomersRepository',
        'criteria'=>'Customers\PagingCriteria'
    ];    
    
    protected $report = [
        'repository'=>'CustomersRepository',
        'logic'=>'ReportLogic'
    ];    
    
    protected $delete = [
        'event'=>'billing.customers.delete.success',
        'request'=>'Customers\DeleteRequest'
    ];
    
    protected $update = [
        'logic'=>'UpdateLogic',
        'request'=>'Customers\UpdateRequest'
    ];
    
    protected $activate = [
        'event'=>'billing.customers.activate.success',
        'request'=>'Customers\ActivateDeactivateRequest'
    ];
    
    protected $deactivate = [
        'event'=>'billing.customers.deactivate.success',
        'request'=>'Customers\ActivateDeactivateRequest'
    ];
    
}
