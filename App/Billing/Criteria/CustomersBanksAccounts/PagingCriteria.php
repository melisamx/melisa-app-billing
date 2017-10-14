<?php

namespace App\Billing\Criteria\CustomersBanksAccounts;

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
            $builder = $builder->where('b.name', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'customersBanksAccounts.*',
                'b.name as bank',
                'c.name as coin',
            ])
            ->join('banks as b', 'b.id', '=', 'customersBanksAccounts.idBank')
            ->join('coins as c', 'c.id', '=', 'customersBanksAccounts.idCoin')
            ->orderBy('b.name');        
    }
    
}
