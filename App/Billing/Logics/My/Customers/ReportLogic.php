<?php

namespace App\Billing\Logics\My\Customers;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\CustomersRepository;

/**
 * Report my customers
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
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
                'waytopay',
                'contributor'=>function($query) {
                    $query->with([
                        'addresses'=>function($query) {
                            $query->with([
                                'country',
                                'state',
                                'municipality',
                            ]);
                        },
                    ]);
                }
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));        
    }
    
}
