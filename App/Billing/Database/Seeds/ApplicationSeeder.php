<?php

namespace App\Billing\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationSeeder extends InstallSeeder
{
    
    public function run()
    {        
        $this->installApplication('billing', [
            'name'=>'Billing',
            'description'=>'Application Billing',
            'nameSpace'=>'Melisa.billing',
            'typeSecurity'=>'art',
            'version'=>'1.21.1',
            'comments'=>'Se agregaron módulos para administrar comisionistas'
        ]);        
    }
    
}
