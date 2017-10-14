<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomerGroupsIdentitiesController extends CrudController
{
    
    protected $paging = [
        'request'=>'CustomerGroupsIdentities\PagingRequest',
        'criteria'=>'CustomerGroupsIdentities\PagingCriteria',
    ];    
    
    protected $create = [
        'request'=>'CustomerGroupsIdentities\CreateRequest',
    ];
    
}
