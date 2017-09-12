<?php

namespace App\Billing\Http\Controllers\Modules;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Billing\Modules\Desktop\ExchangeRates\AddModule;
use App\Billing\Modules\Desktop\ExchangeRates\ViewModule;
use App\Billing\Modules\Desktop\ExchangeRates\UpdateModule;

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
    
    public function update(UpdateModule $module)
    {        
        return $module->render();        
    }
    
}
