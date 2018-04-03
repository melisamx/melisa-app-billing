<?php

namespace App\Billing\Http\Controllers\Api\v1;

use App\Billing\Http\Controllers\PaymentMethodsController as BasePaymentMethodsController;
use Melisa\Laravel\Http\Controllers\ApiCrudTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PaymentMethodsController extends BasePaymentMethodsController
{
    use ApiCrudTrait;
    
}
