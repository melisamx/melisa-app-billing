<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\Repositories;
use App\Billing\Models\RepositoriesIdentities;

/**
 * Install defaul repositories
 *
 * @author Luis Josafat Heredia Contreras
 */
class RepositoriesIdentitiesSeeder extends InstallSeeder
{
    
    public function run()
    {
        RepositoriesIdentities::updateOrCreate([
            'idRepository'=>$this->findRepository('BROKER'),
            'idIdentityCreated'=>$this->findIdentity()->id,
            'idIdentity'=>$this->findIdentity()->id
        ]);
    }
    
    public function findRepository($name)
    {
        return Repositories::where('name', $name)->first()->id;
    }
}
