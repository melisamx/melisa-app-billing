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
            'account'=>'a.name',
            'documents'=>'i.folio',
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
            ->with([
                'documents'=>function($query) {
                    $query
                        ->select([
                            'id',
                            'idSerie',
                            'folio'
                        ])
                        ->with([
                            'serie'=>function($query) {
                                $query->select([
                                    'id',
                                    'serie'
                                ]);
                            }
                        ]);
                }
            ])
            ->join('accountingAccounts as a', 'a.id', '=', 'accountsReceivable.idAccountingAccount')
            ->leftjoin('documents as i', 'i.id', '=', 'accountsReceivable.idInvoice')
            ->where('idAccountReceivableStatus', AccountsReceivableStatus::NNEW)
            ->orderBy('createdAt', 'desc');
    }
    
}
