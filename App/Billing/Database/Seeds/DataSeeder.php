<?php 

namespace App\Billing\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Database\Seeds\Data\SeriesSeeder;
use App\Billing\Database\Seeds\Data\AccountsSeeder;
use App\Billing\Database\Seeds\Data\RepositoriesSeeder;
use App\Billing\Database\Seeds\Data\RepositoriesIdentitiesSeeder;

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
            'voucherTypes',
            'fiscalRegime',
            'taxes',
            'invoiceStatus',
            'debtsToPayStatus',
            'accountsReceivableStatus',
            'waytopay',
            'coins',
            'banks',
            'typesFactor',
            'useCfdi',
            'paymentMethods',
        ]);
        $this->call(SeriesSeeder::class);
        $this->call(AccountsSeeder::class);
        $this->call(RepositoriesSeeder::class);
        $this->call(RepositoriesIdentitiesSeeder::class);
    }
    
}
