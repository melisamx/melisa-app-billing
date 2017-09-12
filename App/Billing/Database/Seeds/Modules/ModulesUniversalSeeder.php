<?php

namespace App\Billing\Database\Seeds\Modules;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesUniversalSeeder extends InstallSeeder
{
    
    public function run()
    {        
        $this->invoice();
        $this->series();
        $this->accounts();
        $this->debtsToPay();
        $this->accountsReceivable();
        $this->csd();
        $this->coins();
        $this->banks();
        $this->paymentMethods();
        $this->waytopay();
        $this->exchangeRates();
        $this->referralNotes();
    }
    
    public function referralNotes()
    {
        $this->installModuleJson('Universal/ReferralNotes', [
            'create',
            'paging',
            'report',
        ]);
    }
    
    public function exchangeRates()
    {
        $this->installModuleJson('Universal/ExchangeRates', [
            'create',
            'paging',
            'update',
            'delete',
            'report',
        ]);
    }
    
    public function waytopay()
    {
        $this->installModuleJson('Universal/Waytopay', [
            'paging',
        ]);
    }
    
    public function paymentMethods()
    {
        $this->installModuleJson('Universal/PaymentMethods', [
            'paging',
        ]);
    }
    
    public function coins()
    {
        $this->installModuleJson('Universal/Coins', [
            'paging',
        ]);
    }
    
    public function banks()
    {
        $this->installModuleJson('Universal/Banks', [
            'create',
            'paging',
            'delete',
            'update',
            'report',
        ]);
    }
    
    public function csd()
    {
        $this->installModuleJson('Universal/Csd', [
            'create',
            'paging',
            'report',
            'delete',
        ]);
    }
    
    public function accountsReceivable()
    {
        $this->installModuleJson('Universal/AccountsReceivable', [
            'create',
            'paging',
            'report',
            'charged',
        ]);
    }
    
    public function debtsToPay()
    {
        $this->installModuleJson('Universal/DebtsToPay', [
            'create',
            'paging',
            'report',
            'payoff',
        ]);
    }
    
    public function accounts()
    {
        $this->installModuleJson('Universal/Accounts', [
            'create',
            'delete',
            'paging',
            'report',
            'update',
        ]);
    }
    
    public function series()
    {
        $this->installModuleJson('Universal/Series', [
            'create',
            'delete',
            'paging',
            'report',
            'update',
        ]);
    }
    
    public function invoice()
    {
        $this->installModuleJson('Universal/Invoice', [
            'report',
            'cancel',
            'create',
            'paging',
            'pdf',
            'xml',
        ]);
        
        $this->installAssetCss('billing.invoice.preview', [
            'name'=>'Billing invoice preview',
            'path'=>'/billing/css/invoice-preview.min.css',
        ]);
    }
    
}
