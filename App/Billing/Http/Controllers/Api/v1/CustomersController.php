<?php

namespace App\Billing\Http\Controllers\Api\v1;

use App\Billing\Http\Controllers\CustomersController as BaseCustomersController;
use Melisa\Laravel\Http\Controllers\ApiCrudTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersController extends BaseCustomersController
{
    use ApiCrudTrait;
    
}
