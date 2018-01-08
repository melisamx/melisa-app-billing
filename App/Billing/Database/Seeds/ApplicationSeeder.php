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
            'version'=>'1.20.1',
            'comments'=>'Se ajusto no convertir en mayusculas algunas columnas'
        ]);        
    }
    
}
