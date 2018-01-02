<?php

namespace App\Billing\Criteria\My\Customers;

use Melisa\Laravel\Criteria\FilterCriteria;
use Melisa\core\LogicBusiness;
use App\Billing\Logics\Repositories\IdentitiesPrivilegeTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingCriteria extends FilterCriteria
{
    use LogicBusiness;
    use IdentitiesPrivilegeTrait;
    
    public function apply($model, $repository, array $input = [])
    {        
        $builder = parent::apply($model, $repository, $input, [
            'name'=>'c.name'
        ]);
        
        if( isset($input['query'])) {
            $builder = $builder->where('c.name', 'like', '%' . $input['query'] . '%');
        }
        
        $identitiesPrivilege = $this->getIdentitiesPrivilege();
        
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
            ->orderBy('c.name')
            ->whereIn('customers.idIdentityCreated', $identitiesPrivilege);        
    }
    
}
