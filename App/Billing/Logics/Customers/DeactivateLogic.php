<?php

namespace App\Billing\Logics\Customers;

use Melisa\Laravel\Logics\DeactivateLogic as BaseDeactivateLogic;
use App\Billing\Repositories\CustomersRepository;

/**
 * Deactivate customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeactivateLogic extends BaseDeactivateLogic
{
    
    protected $fireEvent = 'billing.customers.deactivate.success';
    protected $messageErrorInvalid = 'Cliente invalido';
    protected $messageErrorAlready = 'El cliente ya se encuentra desactivado';

    public function __construct(CustomersRepository $repository)
    {        
        $this->repository = $repository;        
    }
    
}
