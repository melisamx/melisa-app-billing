<?php 

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CoinsController extends CrudController
{
    
    protected $paging = [
        'request'=>'Coins\PagingRequest',
        'criteria'=>'Coins\PagingCriteria',
    ];
    
}
