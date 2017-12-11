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
            'type'=>'t.name',
        ]);
        return $builder
            ->select([
                'documents.*'
            ])
            ->join('documentStatus as s', 's.id', 'documents.idDocumentStatus')
            ->join('documentTypes as t', 't.id', 'documents.idDocumentType')
            ->join('customers as c', 'c.id', 'documents.idCustomer')
            ->join('contributors as co', 'co.id', 'c.idContributor')
            ->with([
                'serie',
                'status',
                'type',
                'customer'=>function($query) {
                    $query->with([
                        'contributor'
                    ]);
                }
            ])
            ->orderBy('createdAt', 'desc');
    }
    
}
