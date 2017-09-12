<?php

namespace App\Billing\Logics\ExchangeRates;

use Melisa\Laravel\Logics\UpdateLogic as BaseUpdateLogic;
use App\Billing\Repositories\ExchangeRatesRepository;

/**
 * Update exhange rate
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends BaseUpdateLogic
{
    
    protected $fireEvent = 'billing.exchangeRates.update.success';
    protected $fieldIdIdentityCreated = 'idIdentityUpdated';
    
    public function __construct(
        ExchangeRatesRepository $repo
    )
    {
        $this->repository = $repo;
    }
    
}
