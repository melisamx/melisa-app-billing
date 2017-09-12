<?php

namespace App\Billing\Criteria\ExchangeRates;

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
            $builder = $builder->where('exchangeRates.date', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'exchangeRates.*',
                'c.name as coin',
                'c.shortName',
            ])
            ->join('coins as c', 'c.id', '=', 'exchangeRates.idCoin')
            ->orderBy('exchangeRates.date', 'desc');        
    }
    
}
