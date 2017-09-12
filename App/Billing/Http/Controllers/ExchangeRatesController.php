<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ExchangeRatesController extends CrudController
{
    
    protected $paging = [
        'request'=>'ExchangeRates\PagingRequest',
        'criteria'=>'ExchangeRates\PagingCriteria',
    ];
    
    protected $create = [
        'request'=>'ExchangeRates\CreateRequest',
        'logic'=>'CreateLogic',
    ];
    
    protected $update = [
        'request'=>'ExchangeRates\UpdateRequest',
        'logic'=>'UpdateLogic',
    ];
    
}
