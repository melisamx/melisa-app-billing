<?php

namespace App\Billing\Database\Seeds\Modules;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesUniversalSeeder extends InstallSeeder
{
    
    public function run()
    {        
        $this->invoice();        
    }
    
    public function invoice()
    {
        $this->installModuleJson('Universal/Invoice', [
            'cancel',
            'create',
            'paging',
            'pdf',
            'xml',
        ]);
    }
    
}
