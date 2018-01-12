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
        $this->documents();
        $this->series();
        $this->accountingAccounts();
        $this->debtsToPay();
        $this->accountsReceivable();
        $this->csd();
        $this->coins();
        $this->banks();
        $this->paymentMethods();
        $this->waytopay();
        $this->exchangeRates();
        $this->referralNotes();
        $this->contributors();
        $this->customers();
        $this->customersAddresses();
        $this->customersContacts();        
        $this->customersBanksAccounts();
        $this->repositories();
        $this->cfdi();
        $this->bankAccounts();
        $this->my();
        $this->providers();
    }
    
    public function providers()
    {        
        $this->installModuleJson('Universal/Providers', [
            'paging',
        ]);
        $this->installModuleJson('Universal/Providers/CommissionAgent', [
            'paging',
            'create',
            'delete',
            'update',
            'report',
        ]);
    }
    
    public function my()
    {        
        $this->installModuleJson('Universal/My/Customers', [
            'create',
            'paging',
            'delete',
            'update',
            'report',
        ]);
        $this->installModuleJson('Universal/My/CustomersAddresses', [
            'create',
            'paging',
            'delete',
            'update',
            'report',
        ]);
    }
    
    public function bankAccounts()
    {
        $this->installModuleJson('Universal/BankAccounts', [
            'create',
            'report',
            'update',
            'delete',
            'paging',
        ]);
    }
    
    public function cfdi()
    {
        $this->installModuleJson('Universal/Cfdi', [
            'create',
        ]);
    }
    
    public function contributors()
    {
        $this->installModuleJson('Universal/Contributors', [
            'paging',
        ]);
    }
    
    public function repositories()
    {
        $this->installModuleJson('Universal/Repositories', [
            'create',
            'report',
            'update',
            'delete',
            'paging',
            'activate',
            'deactivate',
        ]);
    }
    
    public function customers()
    {
        $this->installModuleJson('Universal/Customers', [
            'paging',
            'create',
            'delete',
            'report',
            'update',
            'activate',
            'deactivate',
        ]);
    }
    
    public function customersBanksAccounts()
    {
        $this->installModuleJson('Universal/CustomersBanksAccounts', [
            'create',
            'paging',
            'delete',
            'activate',
            'deactivate',
        ]);
    }
    
    public function customersAddresses()
    {
        $this->installModuleJson('Universal/CustomersAddresses', [
            'create',
            'paging',
            'delete',
            'report',
            'update',
        ]);
    }
    
    public function customersContacts()
    {
        $this->installModuleJson('Universal/CustomersContacts', [
            'create',
            'paging',
            'delete',
        ]);
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
            'autoregister',
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
    
    public function accountingAccounts()
    {
        $this->installModuleJson('Universal/AccountingAccounts', [
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
    
    public function documents()
    {
        $this->installModuleJson('Universal/Documents', [
            'report',
            'cancel',
            'create',
            'paging',
            'pdf',
            'xml',
            'delete',
        ]);
        
        $this->installAssetCss('billing.documents.preview', [
            'name'=>'Billing documents preview',
            'path'=>'/billing/css/documents-preview.min.css',
        ]);
    }
    
}
