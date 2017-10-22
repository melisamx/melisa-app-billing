<?php

namespace App\Billing\Criteria\Customers;

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
        $builder = parent::apply($model, $repository, $input, [
            'name'=>'c.name'
        ]);
        
        if( isset($input['query'])) {
            $builder = $builder->where('c.name', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'customers.*',
                'c.name',
                'c.rfc',
                'c.email',
                'p.name as waytopay',
                'r.name as repository',
            ])
            ->join('repositories as r', 'r.id', '=', 'customers.idRepository')
            ->join('contributors as c', 'c.id', '=', 'customers.idContributor')
            ->join('waytopay as p', 'p.id', '=', 'customers.idWaytopay')
            ->orderBy('c.name');        
    }
    
}
