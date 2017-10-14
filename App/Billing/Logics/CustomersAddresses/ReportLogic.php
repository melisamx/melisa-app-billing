<?php

namespace App\Billing\Logics\CustomersAddresses;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\ContributorsAddressesRepository;

/**
 * Report billing applications
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repository;
    protected $estateTypes;

    public function __construct(
        ContributorsAddressesRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {        
        $record = $this->repository
            ->with([
                'customer',
                'country',
                'municipality',
                'state',
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));        
    }
    
}
