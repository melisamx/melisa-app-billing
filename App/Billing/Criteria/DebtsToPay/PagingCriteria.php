<?php

namespace App\Billing\Criteria\DebtsToPay;

use Melisa\Laravel\Criteria\FilterCriteria;
use Melisa\Laravel\Criteria\ApplySort;
use App\Billing\Models\DebtsToPayStatus;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingCriteria extends FilterCriteria
{
    use ApplySort;
    
    public function apply($model, $repository, array $input = [])
    {
        $builder = parent::apply($model, $repository, $input, [
            'account'=>'a.name'
        ]);
        $builder = $this->applySort($builder, $input);
        
        return $builder
            ->select([
                'debtsToPay.*',
                'p.name as provider',
                \DB::raw(implode('', [
                    '(',
                    'select sum(amountPayable) from debtsToPay where ',
                    'idDebtsToPayStatus = ' . DebtsToPayStatus::NNEW,
                    ') as totalPayable'
                ])),
                \DB::raw(implode('', [
                    '(',
                    'select sum(amountPayable) from debtsToPay where ',
                    'idDebtsToPayStatus = ' . DebtsToPayStatus::NNEW,
                    ' and ',
                    'expiredDate = 1',
                    ') as totalPayableExpired'
                ]))
            ])
            ->with([
                'provider'=>function($query) {
                    $query->with('type');
                },
                'contributor'
            ])
            ->leftJoin('providers as p', 'p.id', '=', 'debtsToPay.idProvider')
            ->where('idDebtsToPayStatus', DebtsToPayStatus::NNEW)
            ->orderBy('createdAt', 'desc');
    }
    
}
