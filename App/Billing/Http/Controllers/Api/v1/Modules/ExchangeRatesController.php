<?php

namespace App\Billing\Http\Controllers\Api\v1\Modules;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Billing\Modules\Api\ExchangeRates\ViewModule;
use App\Billing\Modules\Api\ExchangeRates\AddModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ExchangeRatesController extends Controller
{
    
    public function view(ViewModule $module)
    {        
        return $module->render();        
    }
    
    public function add(AddModule $module)
    {        
        return $module->render();        
    }
    
}
