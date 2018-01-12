<?php

namespace App\Billing\Http\Controllers\Providers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CommissionAgentController extends CrudController
{
    
    protected $paging = [
        'repository'=>'ProvidersRepository',
        'criteria'=>'Providers\CommissionAgent\PagingCriteria',
        'request'=>'Providers\CommissionAgent\PagingRequest',
    ];
    
    protected $create = [
        'repository'=>'ProvidersRepository',
        'logic'=>'CreateLogic',
        'request'=>'Providers\CommissionAgent\CreateRequest'
    ];
    
    protected $update = [
        'repository'=>'ProvidersRepository',
        'logic'=>'UpdateLogic',
        'request'=>'Providers\CommissionAgent\UpdateRequest'
    ];
    
    protected $delete = [
        'repository'=>'ProvidersRepository',
    ];
    
    protected $report = [
        'repository'=>'ProvidersRepository',
        'logic'=>'ReportLogic',
        'module'=>'Universal\Providers\CommissionAgent\ReportModule',
    ];
    
}
