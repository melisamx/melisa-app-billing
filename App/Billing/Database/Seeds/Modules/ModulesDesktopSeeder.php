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
        $this->series();        
        $this->debtsToPay();        
    }
    
    public function debtsToPay()
    {
        $this->installModuleJson('Desktop/DebtsToPay', [
            'add',
            'view',
        ]);
    }
    
    public function series()
    {
        $this->installModuleJson('Desktop/Series', [
            'add',
            'update',
            'view',
        ]);
    }
    
    public function invoice()
    {
        $this->installModuleJson('Desktop/Invoice', [
            'view',
        ]);
    }
    
}
