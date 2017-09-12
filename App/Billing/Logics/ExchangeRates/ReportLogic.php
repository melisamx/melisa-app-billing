<?php

namespace App\Billing\Logics\ExchangeRates;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\ExchangeRatesRepository;

/**
 * Report exchange rate
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repository;
    protected $estateTypes;

    public function __construct(
        ExchangeRatesRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {        
        $record = $this->repository
            ->with([
                'coin'
            ])
            ->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));        
    }
    
}
