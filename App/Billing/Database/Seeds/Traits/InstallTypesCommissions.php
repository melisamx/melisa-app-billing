<?php

namespace App\Billing\Database\Seeds\Traits;

use App\Billing\Models\TypesCommissions;

trait InstallTypesCommissions
{
    
    public function installTypeCommission($key, $name)
    {
        return TypesCommissions::updateOrCreate([
            'key'=>$key,
            'name'=>$name,
        ]);
    }
    
}