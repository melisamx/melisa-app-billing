<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\Repositories;

/**
 * Install defaul repositories
 *
 * @author Luis Josafat Heredia Contreras
 */
class RepositoriesSeeder extends InstallSeeder
{
    
    public function run()
    {        
        Repositories::updateOrCreate([
            'name'=>'BROKER',
        ], [
            'idIdentityCreated'=>$this->findIdentity()->id,
        ]);        
    }
    
}
