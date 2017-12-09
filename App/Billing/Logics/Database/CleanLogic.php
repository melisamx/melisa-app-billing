<?php

namespace App\Billing\Logics\Database;

use App\Billing\Models\Documents;
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
        Documents::whereNotNull('id')->delete();
        Customers::whereNotNull('id')->delete();
        Contributors::whereNotNull('id')->delete();
    }
    
}
