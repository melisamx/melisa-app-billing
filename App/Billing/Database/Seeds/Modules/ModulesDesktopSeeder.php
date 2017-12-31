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
        $this->documents();        
        $this->series();        
        $this->debtsToPay();        
        $this->accountsReceivable();        
        $this->csd();
        $this->exchangeRates();
        $this->banks();
        $this->referralNotes();
        $this->customers();
        $this->customersAddresses();
        $this->customersContacts();
        $this->customersBanksAccounts();
        $this->customerGroups();
        $this->customerGroupsCustomers();
        $this->customerGroupsIdentities();
        $this->repositories();
        $this->accountingAccounts();
        $this->cfdi();
        $this->bankAccounts();
    }    
    
    public function cfdi()
    {
        $this->installModuleJson('Desktop/Cfdi', [
            'add',
        ]);
    }
    
    public function bankAccounts()
    {
        $this->installModuleJson('Desktop/BankAccounts', [
            'add',
            'view',
            'update',
        ]);
    }
    
    public function accountingAccounts()
    {
        $this->installModuleJson('Desktop/AccountingAccounts', [
            'add',
            'view',
            'update',
        ]);
    }
    
    public function repositories()
    {
        $this->installModuleJson('Desktop/Repositories', [
            'add',
            'update',
            'view',
        ]);
    }
    
    public function customerGroupsIdentities()
    {
        $this->installModuleJson('Desktop/CustomerGroupsIdentities', [
            'add',
            'view',
        ]);
    }
    
    public function customerGroupsCustomers()
    {
        $this->installModuleJson('Desktop/CustomerGroupsCustomers', [
            'add',
            'view',
        ]);
    }
    
    public function customerGroups()
    {
        $this->installModuleJson('Desktop/CustomerGroups', [
            'add',
            'update',
            'view',
        ]);
    }
    
    public function customersBanksAccounts()
    {
        $this->installModuleJson('Desktop/CustomersBanksAccounts', [
            'add',
        ]);
    }
    
    public function customersAddresses()
    {
        $this->installModuleJson('Desktop/CustomersAddresses', [
            'add',
            'update',
        ]);
    }
    
    public function customersContacts()
    {
        $this->installModuleJson('Desktop/CustomersContacts', [
            'add',
        ]);
    }
    
    public function customers()
    {
        $this->installModuleJson('Desktop/Customers', [
            'add',
            'update',
            'view',
        ]);
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
        $this->installAssetCss('app.billing.accountsReceivable.view', [
            'name'=>'CSS accounts receivable view',
            'path'=>'/billing/css/accounts-receivable-view.min.css'
        ]);
    }
    
    public function debtsToPay()
    {
        $this->installModuleJson('Desktop/DebtsToPay', [
            'add',
            'view',
            'payoff',
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
    
    public function documents()
    {
        $this->installModuleJson('Desktop/Documents', [
            'view',
        ]);
        $this->installAssetCss('app.billing.document.preview', [
            'name'=>'CSS billing documents preview',
            'path'=>'/billing/css/documents-preview.min.css'
        ]);
    }
    
}
