<?php

namespace App\Billing\Database\Seeds\Traits;

use App\Billing\Models\Concepts;
use App\Billing\Models\ConceptUnits;
use App\Billing\Models\ConceptKeys;

trait InstallConcept
{
    
    public function installConceptUnit($key, $name)
    {
        return ConceptUnits::updateOrCreate([
            'key'=>$key,
            'name'=>$name,
        ]);
    }
    
    public function installConcept($key, $name, $conceptKey = null, $conceptKeyName = null)
    {
        if( is_null($conceptKey)) {
            return Concepts::updateOrCreate([
                'key'=>$key,
            ], [
                'name'=>$name,
                'idIdentityCreated'=>$this->findIdentity()->id,
            ]);
        }
        
        $conceptKey = $this->findConceptKey($conceptKey, $conceptKeyName);
        
        return Concepts::updateOrCreate([
                'key'=>$key,
            ], [
                'name'=>$name,
                'idIdentityCreated'=>$this->findIdentity()->id,
                'idConceptKey'=>$conceptKey ? $conceptKey->id : null
            ]);
    }
    
    public function findConceptKey($key, $name = null)
    {
        $conceptKey = ConceptKeys::where('key', $key)->first();
        
        if( $name) {
            return ConceptKeys::updateOrCreate([
                'key'=>$key,
            ], [
                'name'=>$name,
            ]);
        }
        
        return $conceptKey;
    }
    
    public function findConcept($key)
    {
        return Concepts::where('key', $key)->first()->id;
    }
    
}