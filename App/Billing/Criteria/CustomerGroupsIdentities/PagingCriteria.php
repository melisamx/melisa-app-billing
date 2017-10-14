<?php

namespace App\Billing\Criteria\CustomerGroupsIdentities;

use Melisa\Laravel\Criteria\FilterCriteria;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingCriteria extends FilterCriteria
{
    
    public function apply($model, $repository, array $input = [])
    {        
        $builder = parent::apply($model, $repository, $input);
        $dbCore = config('database.connections.core.database') . '.';
        
        if( isset($input['query'])) {
            $builder = $builder->where('i.displayEspecific', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'customerGroupsIdentities.*',
                'i.displayEspecific',
            ])
            ->join(\DB::raw($dbCore . 'identities i'), 'i.id', '=', 'customerGroupsIdentities.idIdentity')
            ->orderBy('i.displayEspecific');        
    }
    
}
