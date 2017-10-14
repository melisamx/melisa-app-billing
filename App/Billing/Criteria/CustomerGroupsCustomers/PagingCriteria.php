<?php

namespace App\Billing\Criteria\CustomerGroupsCustomers;

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
            $builder = $builder->where('co.name', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'customerGroupsCustomers.*',
                'co.name',
                'co.rfc'
            ])
            ->join('customers as c', 'c.id', '=', 'customerGroupsCustomers.idCustomer')
            ->join('contributors as co', 'co.id', '=', 'c.idContributor')
            ->orderBy('co.name');        
    }
    
}
