<?php

namespace App\Billing\Logics\Customers;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\CustomersRepository;

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
        CustomersRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {        
        $record = $this->repository
            ->with([
                'repository',
                'contributor',
                'waytopay',
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));        
    }
    
}
