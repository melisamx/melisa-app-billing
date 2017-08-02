<?php

namespace App\Billing\Database\Seeds\Modules;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesDesktopSeeder extends InstallSeeder
{
    
    public function run()
    {        
        $this->invoice();        
    }
    
    public function invoice()
    {
        $this->installModuleJson('Desktop/Invoice', [
            'view',
        ]);
    }
    
}
