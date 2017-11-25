<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\Accounts;

/**
 * Install default accounts
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountsSeeder extends InstallSeeder
{
    
    public function run()
    {
        Accounts::updateOrCreate([
            'name'=>'TELMEX',
            'key'=>'telmex',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
        Accounts::updateOrCreate([
            'name'=>'CFE',
            'key'=>'cfe',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
        Accounts::updateOrCreate([
            'name'=>'Facturación',
            'key'=>'invoice',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
    }
    
}
