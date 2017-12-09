<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\Providers;

/**
 * Install default providers
 *
 * @author Luis Josafat Heredia Contreras
 */
class ProvidersSeeder extends InstallSeeder
{
    
    public function run()
    {
        $idIdentity = $this->findIdentity()->id;
        Providers::updateOrCreate([
            'name'=>'TELMEX',
            'slug'=>'telmex',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$idIdentity
        ]);
        Providers::updateOrCreate([
            'name'=>'CFE',
            'slug'=>'cfe',
        ], [
            'expirationDays'=>21,
            'idIdentityCreated'=>$idIdentity
        ]);
    }
    
}
