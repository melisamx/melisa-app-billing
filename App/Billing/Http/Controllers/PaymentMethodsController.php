<?php 

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PaymentMethodsController extends CrudController
{
    
    protected $paging = [
        'request'=>'PaymentMethods\PagingRequest',
        'criteria'=>'PaymentMethods\PagingCriteria'
    ];
    
}
