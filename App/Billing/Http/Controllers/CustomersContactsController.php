<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersContactsController extends CrudController
{
    
    protected $paging = [
        'criteria'=>'CustomersContacts\PagingCriteria',
        'request'=>'CustomersContacts\PagingRequest',
    ];
    
}
