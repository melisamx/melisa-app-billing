<?php

namespace App\Billing\Logics\BankAccounts;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\BankAccountsRepository;

/**
 * Report bank accounts
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repository;

    public function __construct(
        BankAccountsRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {
        $record = $this->repository
            ->with([
                'bank',
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));
    }
    
}
