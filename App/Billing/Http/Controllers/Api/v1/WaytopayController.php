<?php

namespace App\Billing\Http\Controllers\Api\v1;

use App\Billing\Http\Controllers\WaytopayController as BaseWaytopayController;
use Melisa\Laravel\Http\Controllers\ApiCrudTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class WaytopayController extends BaseWaytopayController
{
    use ApiCrudTrait;
    
}
