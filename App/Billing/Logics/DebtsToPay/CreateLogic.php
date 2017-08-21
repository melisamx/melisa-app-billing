<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Billing\Models\DebtsToPayStatus;

/**
 * Create debts to pay
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $eventSuccess = 'billing.debtsToPay.create.success';
    
    public function __construct(
        DebtsToPayRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function create(&$input)
    {        
        $input ['idDebtsToPayStatus']= DebtsToPayStatus::NNEW;
        return parent::create($input);
    }
    
}
