<?php

namespace App\Billing\Criteria\My\CustomersAddresses;

use Melisa\Laravel\Criteria\FilterCriteria;
use Melisa\core\LogicBusiness;
use App\Billing\Logics\Repositories\IdentitiesPrivilegeTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingCriteria extends FilterCriteria
{
    use LogicBusiness;
    use IdentitiesPrivilegeTrait;
    
    public function apply($model, $repository, array $input = [])
    {
        $builder = parent::apply($model, $repository, $input, [
            'country'=>'c.name',
            'state'=>'s.name',
            'municipality'=>'m.name',
            'idContributor'=>'cu.idContributor',
        ]);
        
        $dbPeople = config('database.connections.people.database') . '.';        
        $repositoriesPrivilege = $this->getRepositoriesPrivilege();
        
        return $builder
            ->select([
                'contributorsAddresses.*'
            ])
            ->with([
                'country',
                'state',
                'municipality',
            ])
            ->join('customers as cu', 'cu.idContributor', '=', 'contributorsAddresses.idContributor')
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
            ->orderBy('contributorsAddresses.isDefault', 'desc')
            ->whereIn('cu.idRepository', $repositoriesPrivilege);        
    }
    
}
