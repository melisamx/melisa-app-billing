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
        $this->accountsReceivable();        
        $this->csd();
        $this->exchangeRates();
        $this->banks();
        $this->referralNotes();
    }
    
    public function referralNotes()
    {
        $this->installModuleJson('Desktop/ReferralNotes', [
            'view',
        ]);
    }
    
    public function banks()
    {
        $this->installModuleJson('Desktop/Banks', [
            'add',
            'update',
            'view',
        ]);
    }
    
    public function exchangeRates()
    {
        $this->installModuleJson('Desktop/ExchangeRates', [
            'add',
            'update',
            'view',
        ]);
    }
    
    public function csd()
    {
        $this->installModuleJson('Desktop/Csd', [
            'add',
            'view',
        ]);
    }
    
    public function accountsReceivable()
    {
        $this->installModuleJson('Desktop/AccountsReceivable', [
            'add',
            'view',
        ]);
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
