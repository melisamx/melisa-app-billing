<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Billing\Models\DebtsToPayStatus;

class ProvidersLogic extends BaseCreateLogic
{
    
    public function __construct(
        DebtsToPayRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function save(&$input)
    {
        $input ['idDebtsToPayStatus']= DebtsToPayStatus::NNEW;
        return parent::save($input);
    }
    
}
