<?php

namespace App\Billing\Criteria\AccountsReceivable;

use Melisa\Laravel\Criteria\FilterCriteria;
use Melisa\Laravel\Criteria\ApplySort;
use App\Billing\Models\AccountsReceivableStatus;

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
                'accountsReceivable.*',
                'a.name as account',
                \DB::raw(implode('', [
                    '(',
                        'select sum(amountCharged) from accountsReceivable where ',
                        'idAccountReceivableStatus = ' . AccountsReceivableStatus::NNEW,
                    ') as totalCharged'
                ])),
                \DB::raw(implode('', [
                    '(',
                        'select sum(amountCharged) from accountsReceivable where ',
                        'idAccountReceivableStatus = ' . AccountsReceivableStatus::NNEW,
                        ' and ',
                        'expiredDate = 1',
                    ') as totalChargedExpired'
                ]))
            ])
            ->join('accounts as a', 'a.id', '=', 'accountsReceivable.idAccount')
            ->where('idAccountReceivableStatus', AccountsReceivableStatus::NNEW)
            ->orderBy('createdAt', 'desc');
    }
    
}
