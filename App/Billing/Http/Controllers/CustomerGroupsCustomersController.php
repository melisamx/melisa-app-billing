<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomerGroupsCustomersController extends CrudController
{
    
    protected $paging = [
        'request'=>'CustomerGroupsCustomers\PagingRequest',
        'criteria'=>'CustomerGroupsCustomers\PagingCriteria',
    ];
    
    protected $create = [
        'request'=>'CustomerGroupsCustomers\CreateRequest',
    ];
    
}
