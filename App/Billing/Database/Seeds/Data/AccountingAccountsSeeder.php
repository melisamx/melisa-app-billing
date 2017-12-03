<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\AccountingAccounts;

/**
 * Install default accounting accounts
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountingAccountsSeeder extends InstallSeeder
{
    
    public function run()
    {
        AccountingAccounts::updateOrCreate([
            'name'=>'TELMEX',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
        AccountingAccounts::updateOrCreate([
            'name'=>'CFE',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
    }
    
}
