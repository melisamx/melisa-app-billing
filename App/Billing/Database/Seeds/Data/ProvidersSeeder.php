<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Database\Seeds\Traits\InstallProvider;

/**
 * Install default providers
 *
 * @author Luis Josafat Heredia Contreras
 */
class ProvidersSeeder extends InstallSeeder
{
    use InstallProvider;
    
    public function run()
    {        
        $this->installProvider('TELMEX', 21, 'otros');
        $this->installProvider('CFE', 21, 'otros');
    }
    
}
