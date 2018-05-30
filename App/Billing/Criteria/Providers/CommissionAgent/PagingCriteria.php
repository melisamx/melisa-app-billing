<?php

namespace App\Billing\Criteria\Providers\CommissionAgent;

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
        
        if( isset($input['query'])) {
            $builder = $builder->where('name', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select('providers.*')
            ->join('typesProviders as tp', 'tp.id', '=', 'providers.idTypeProvider')
            ->where('tp.slug', 'comisionista')
            ->orderBy('providers.name');        
    }
    
}
