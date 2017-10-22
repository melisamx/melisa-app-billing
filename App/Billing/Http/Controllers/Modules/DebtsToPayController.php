<?php 

namespace App\Billing\Http\Controllers\Modules;

use Melisa\Laravel\Http\Controllers\ModuleController;
use App\Billing\Modules\Desktop\DebtsToPay\PayoffModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DebtsToPayController extends ModuleController
{
    
    public function payoff(PayoffModule $module)
    {
        return $module->render();
    }
    
}
