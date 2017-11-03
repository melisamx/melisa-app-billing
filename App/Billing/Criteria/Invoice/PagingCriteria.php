<?php

namespace App\Billing\Criteria\Invoice;

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
        return $builder
            ->with([
                'serie',
                'status',
                'customer'=>function($query) {
                    $query->with([
                        'contributor'
                    ]);
                }
            ])
            ->orderBy('createdAt', 'desc');
    }
    
}
