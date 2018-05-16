<?php

namespace App\Billing\Database\Seeds\Modules;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesApiSeeder extends InstallSeeder
{
    
    public function run()
    {
        $this->customers();
        $this->customersAddresses();
        $this->repositories();
        $this->coins();
    }
    
    public function coins()
    {
        $this->installModuleJson('Api/Coins', [
            'paging',
        ]);
    }
    
    public function repositories()
    {
        $this->installModuleJson('Api/Repositories', [
            'paging',
        ]);
    }
    
    public function customersAddresses()
    {
        $this->installModuleJson('Api/CustomersAddresses', [
            'paging',
        ]);
    }
    
    public function customers()
    {
        $this->installModuleJson('Api/Customers', [
            'paging',
        ]);
    }
    
}
