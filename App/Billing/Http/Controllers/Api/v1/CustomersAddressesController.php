<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersAddressesController extends CrudController
{
    
    protected $paging = [
        'request'=>'CustomersAddresses\Api\PagingRequest',
        'repository'=>'ContributorsAddressesRepository',
        'criteria'=>'CustomersAddresses\Api\PagingCriteria'
    ];
    
}
