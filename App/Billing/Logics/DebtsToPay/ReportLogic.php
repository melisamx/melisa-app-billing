<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DebtsToPayRepository;

/**
 * Report billing applications
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repository;

    public function __construct(
        DebtsToPayRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {        
        $record = $this->repository
            ->with([
                'status',
                'account',
                'voucher',
                'documents',
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));
    }
    
}
