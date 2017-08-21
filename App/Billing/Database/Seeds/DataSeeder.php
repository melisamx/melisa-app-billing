<?php 

namespace App\Billing\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Database\Seeds\Data\SeriesSeeder;
use App\Billing\Database\Seeds\Data\AccountsSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DataSeeder extends InstallSeeder
{
    
    public function run()
    {
        $this->csvImportSimple([
            'fiscalRegime',
            'taxes',
            'invoiceStatus',
            'debtsToPayStatus',
        ]);
        $this->call(SeriesSeeder::class);
        $this->call(AccountsSeeder::class);
    }
    
}
