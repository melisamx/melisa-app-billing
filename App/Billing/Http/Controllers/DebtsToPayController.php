<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Http\Requests\DebtsToPay\PayoffRequest;
use App\Billing\Logics\DebtsToPay\PayoffLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DebtsToPayController extends CrudController
{
    
    protected $create = [
        'request'=>'DebtsToPay\CreateRequest',
        'logic'=>'CreateLogic'
    ];
    
    protected $paging = [
        'request'=>'DebtsToPay\PagingRequest',
        'criteria'=>'DebtsToPay\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\DebtsToPay\ReportModule',
    ];
    
    public function payoff(
        PayoffRequest $request, 
        PayoffLogic $logic
    )
    {
        return response()->data($logic->init($request->allValid()));
    }
    
}
