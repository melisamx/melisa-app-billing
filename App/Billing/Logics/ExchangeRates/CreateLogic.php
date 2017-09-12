<?php

namespace App\Billing\Logics\ExchangeRates;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\ExchangeRatesRepository;

/**
 * Create exchange rate
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    protected $fireEvent = 'billing.exchangeRates.create.success';

    public function __construct(
        ExchangeRatesRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
}