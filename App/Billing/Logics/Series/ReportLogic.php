<?php

namespace App\Billing\Logics\Series;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\SeriesRepository;

/**
 * Report series
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportLogic
{
    use LogicBusiness;
    
    protected $repository;
    protected $estateTypes;

    public function __construct(
        SeriesRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function init($id)
    {        
        $record = $this->repository->findOrFail($id);
        
        if( !$record) {
            return false;
        }
        
        $report = $record->toArray();        
        return json_decode(json_encode($report));        
    }
    
}
