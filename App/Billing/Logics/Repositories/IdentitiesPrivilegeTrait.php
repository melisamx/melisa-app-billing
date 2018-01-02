<?php

namespace App\Billing\Logics\Repositories;

use App\Billing\Repositories\RepositoriesIdentitiesRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait IdentitiesPrivilegeTrait
{
    
    protected $repoIdentities;


    public function getRepositoriesPrivilege()
    {
        static $repoIdentities = null;
        
        if( !$repoIdentities) {
            $repoIdentities = app(RepositoriesIdentitiesRepository::class);
            $this->repoIdentities = $repoIdentities;
        }
        
        $repositories = $repoIdentities->getModel()
            ->select('idRepository')
            ->distinct()
            ->where([
                'idIdentity'=>$this->getIdentity(),
                'active'=>true
            ])
            ->get();
        
        if( !$repositories->count()) {
            return [];
        }
        
        return array_column($repositories->toArray(), 'idRepository');
    }
    
    public function getIdentitiesPrivilege()
    {
        $repositories = $this->getRepositoriesPrivilege();
        
        if( empty($repositories)) {
            return [];
        }
        
        $identities = $this->repoIdentities->getModel()
            ->select('idIdentity')
            ->whereIn('idRepository', $repositories)
            ->groupBy('idIdentity')
            ->get();
        
        if( !$identities->count()) {
            return [];
        }
        
        return array_column($identities->toArray(), 'idIdentity');
    }
    
}
