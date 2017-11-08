<?php

namespace App\Billing\Logics\Fake;

use Illuminate\Database\QueryException;
use Melisa\Laravel\Database\InstallIdentity;
use App\Billing\Models\Contributors;
use App\Billing\Models\ContributorsAddresses;
use App\Billing\Models\Customers;
use App\Billing\Models\Repositories;
use App\Billing\Models\Concepts;
use App\Billing\Models\ConceptKeys;
use App\Billing\Models\ConceptUnits;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AllLogic
{
    use InstallIdentity;
    
    public function init(array $input)
    {
        $this->contributors($input);
        $this->contributorsAddresses($input);
        $this->customers($input);
        $this->conceptKeys();
        $this->concepts();
        $this->conceptUnits();
    }
    
    public function conceptUnits()
    {
        ConceptUnits::updateOrCreate([
            'key'=>'ACT',
            'name'=>'Actividad'
        ]);
    }
    
    public function concepts()
    {
        Concepts::updateOrCreate([
            'idConceptKey'=> ConceptKeys::where('key', '81111504')->first()->id,
            'key'=>1,
            'name'=>'Servicios profesionales correspondientes a la semana en curso'
        ], [
            'idIdentityCreated'=>$this->findIdentity()->id,
        ]);
    }
    
    public function conceptKeys()
    {
        ConceptKeys::updateOrCreate([
            'key'=>'81111504',
            'name'=>'Servicios de programación de aplicaciones'
        ]);
    }
    
    public function customers($input)
    {
        $contributors = Contributors::get();
        $repository = Repositories::first();
        
        foreach($contributors as $contributor) {
            factory(Customers::class)->create([
                'idContributor'=>$contributor->id,
                'idRepository'=>$repository->id,
            ]);
        }
    }
    
    public function contributorsAddresses($input)
    {
        $contributors = Contributors::get();
        
        foreach($contributors as $contributor) {
            factory(ContributorsAddresses::class)->create([
                'idContributor'=>$contributor->id
            ]);
        }        
    }
    
    public function contributors($input)
    {
        factory(Contributors::class, $input['limit'])->create();
    }
    
}
