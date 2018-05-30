<?php

namespace App\Billing\Criteria\CustomersAddresses\Api;

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
            'country'=>'c.name',
            'state'=>'s.name',
            'municipality'=>'m.name',
        ]);
        $dbPeople = config('database.connections.people.database') . '.';
        
        return $builder
            ->select([
                'contributorsAddresses.*'
            ])
            ->with([
                'country',
                'state',
                'municipality',
            ])
            ->join('contributors as co', 'co.id', '=', 'contributorsAddresses.idContributor')
            ->join('customers as cu', 'cu.idContributor', '=', 'co.id')
            ->join(
                \DB::raw($dbPeople . 'countries c'),
                'c.id',
                'contributorsAddresses.idCountry'
            )
            ->join(
                \DB::raw($dbPeople . 'states s'),
                's.id',
                'contributorsAddresses.idState'
            )
            ->join(
                \DB::raw($dbPeople . 'municipalities m'),
                'm.id',
                'contributorsAddresses.idMunicipality'
            )
            ->orderBy('contributorsAddresses.isDefault', 'desc');        
    }
    
}
