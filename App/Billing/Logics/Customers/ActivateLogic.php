<?php

namespace App\Billing\Logics\Customers;

use Melisa\Laravel\Logics\ActivateLogic as BaseActivateLogic;
use App\Billing\Repositories\CustomersRepository;

/**
 * Activate customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class ActivateLogic extends BaseActivateLogic
{
    
    protected $fireEvent = 'billing.customers.activate.success';
    protected $messageErrorInvalid = 'Cliente invalido';
    protected $messageErrorAlready = 'El cliente ya se encuentra activado';

    public function __construct(CustomersRepository $repository)
    {        
        $this->repository = $repository;        
    }
    
}
