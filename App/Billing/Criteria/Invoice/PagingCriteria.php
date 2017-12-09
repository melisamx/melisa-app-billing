<?php

namespace App\Billing\Criteria\Documents;

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
            'status'=>'s.name',
            'customer'=>'co.rfc',
        ]);
        return $builder
            ->select([
                'documents.*'
            ])
            ->join('invoiceStatus as s', 's.id', 'documents.idInvoiceStatus')
            ->join('customers as c', 'c.id', 'documents.idCustomer')
            ->join('contributors as co', 'co.id', 'c.idContributor')
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
