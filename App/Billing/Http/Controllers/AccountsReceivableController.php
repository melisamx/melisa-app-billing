<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Http\Requests\AccountsReceivable\ChargedRequest;
use App\Billing\Logics\AccountsReceivable\ChargedLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountsReceivableController extends CrudController
{
    
    protected $paging = [
        'request'=>'AccountsReceivable\PagingRequest',
        'criteria'=>'AccountsReceivable\PagingCriteria'
    ];
    
    protected $create = [
        'request'=>'AccountsReceivable\AutoRegisterRequest',
        'logic'=>'AutoRegisterLogic'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
    ];
    
    public function charged(
        ChargedRequest $request, 
        ChargedLogic $logic
    )
    {
        return response()->data($logic->init($request->allValid()));
    }
    
}
