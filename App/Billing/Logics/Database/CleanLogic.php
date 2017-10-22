<?php

namespace App\Billing\Logics\Database;

use App\Billing\Models\Invoice;
use App\Billing\Models\Customers;
use App\Billing\Models\Contributors;

/**
 * Remove all records
 *
 * @author Luis Josafat Heredia Contreras
 */
class CleanLogic
{
    
    public function init()
    {
        Invoice::whereNotNull('id')->delete();
        Customers::whereNotNull('id')->delete();
        Contributors::whereNotNull('id')->delete();
    }
    
}
