<?php 

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class WaytopayController extends CrudController
{
    
    protected $paging = [
        'request'=>'Waytopay\PagingRequest',
        'criteria'=>'Waytopay\PagingCriteria'
    ];
    
}
