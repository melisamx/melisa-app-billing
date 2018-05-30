<?php

namespace App\Billing\Criteria\Reports;

use Melisa\Laravel\Criteria\FilterCriteria;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BillsPaidCriteria extends FilterCriteria
{
    
    public function apply($model, $repository, array $input = [])
    {
        $builder = parent::apply($model, $repository, $input, [
            'name'=>'c.name'
        ]);
        
        return $builder
            ->select([
                'c.name',
                'c.rfc',
                \DB::raw('SUM(documents.total) as amount'),
                \DB::raw('COUNT(documents.id) as totalInvoices')
            ])
            ->join('contributorsAddresses as ca', 'ca.id', '=', 'documents.idCustomerAddress')
            ->join('contributors as c', 'c.id', '=', 'ca.idContributor')
            ->join('documentTypes as dt', 'dt.id', '=', 'documents.idDocumentType')
            ->join('documentStatus as ds', 'ds.id', '=', 'documents.idDocumentStatus')
            ->groupBy('c.name')
            ->groupBy('c.rfc')
            ->orderBy('amount', 'desc')
            ->where('dt.name', 'Factura')
            ->where('ds.key', 'new');
    }
    
}
