<?php

namespace App\Billing\Http\Controllers\Modules;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Billing\Modules\Universal\Reports\BillsPaidModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportsController extends Controller
{
    
    public function billsPaid(
        BillsPaidModule $module
    )
    {
        return $module->render();
    }
    
}
