<?php

namespace App\Billing\Database\Seeds;

use Illuminate\Database\Seeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesSeeder extends Seeder
{
    
    public function run()
    {        
        $this->call(Modules\ModulesDesktopSeeder::class);
        $this->call(Modules\ModulesPhoneSeeder::class);
        $this->call(Modules\ModulesUniversalSeeder::class);       
        $this->call(Modules\ModulesApiSeeder::class);
    }
    
}
