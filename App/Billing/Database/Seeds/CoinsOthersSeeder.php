<?php 

namespace App\Billing\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CoinsOthersSeeder extends InstallSeeder
{
    
    public function run()
    {
        $this->jsonImportSimple([
            'coinsOthers',
        ]);
    }
    
}
