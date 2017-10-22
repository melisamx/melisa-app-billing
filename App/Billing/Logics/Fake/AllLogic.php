<?php

namespace App\Billing\Logics\Fake;

use Illuminate\Database\QueryException;
use App\Billing\Models\Contributors;
use App\Billing\Models\ContributorsAddresses;
use App\Billing\Models\Customers;
use App\Billing\Models\Repositories;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AllLogic
{
    
    public function init(array $input)
    {
        $this->contributors($input);
        $this->contributorsAddresses($input);
        $this->customers($input);
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
