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
            'document'=>'d.folio',
            'repository'=>'r.name',
        ]);
        $builder = $this->applySort($builder, $input);
        
        return $builder
            ->select([
                'accountsReceivable.*',
                'co.name as account',
                'co.rfc as accountRfc',
                'co.rfc as accountRfc',
                'r.name as repository',
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
                'document'=>function($query) {
                    $query
                        ->select([
                            'id',
                            'idSerie',
                            'idCustomer',
                            'idCustomerAddress',
                            'idDocumentType',
                            'folio'
                        ])
                        ->with([
                            'type',
                            'customer'=>function($query) {
                                $query->with('repository');
                            },
                            'customerAddress',
                            'serie'=>function($query) {
                                $query->select([
                                    'id',
                                    'serie'
                                ]);
                            }
                        ]);
                }
            ])
            ->join('documents as d', 'd.id', '=', 'accountsReceivable.idDocument')
            ->leftjoin('contributorsAddresses as c', 'c.id', '=', 'd.idCustomerAddress')
            ->leftjoin('contributors as co', 'co.id', '=', 'c.idContributor')
            ->leftjoin('customers as cu', 'cu.id', '=', 'd.idCustomer')
            ->leftjoin('repositories as r', 'r.id', '=', 'cu.idRepository')
            ->where('idAccountReceivableStatus', AccountsReceivableStatus::NNEW)
            ->orderBy('createdAt', 'desc');
    }
    
}
