<?php

namespace App\Billing\Database\Seeds\Traits;

use App\Billing\Models\TypesProviders;
use App\Billing\Models\Providers;

trait InstallProvider
{
    
    public function installTypeProvider($name, $slug = null)
    {
        return TypesProviders::updateOrCreate([
            'name'=>$name
        ], [
            'slug'=>is_null($slug) ? str_slug($name) : $slug
        ]);
    }
    
    public function installProvider($name, $expirationDays, $type)
    {
        return Providers::updateOrCreate([
            'name'=>$name,
        ], [
            'idTypeProvider'=>$this->findTypeProvider($type)->id,
            'idIdentityCreated'=>$this->findIdentity()->id,
            'slug'=>str_slug($name),
            'expirationDays'=>$expirationDays,
        ]);
    }
        
    public function findProvider($slug)
    {
        return Providers::where('slug', $slug)->first();
    }
        
    public function findTypeProvider($slug)
    {
        return TypesProviders::where('slug', $slug)->first();
    }
    
}