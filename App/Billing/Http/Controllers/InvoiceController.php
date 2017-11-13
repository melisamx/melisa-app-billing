<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Http\Requests\Invoice\CancelRequest;
use App\Billing\Logics\Invoice\CancelLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceController extends CrudController
{    
    
    protected $create = [
        'logic'=>'CreateLogic'
    ];
    
    protected $update = [
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'request'=>'Invoice\PagingRequest',
        'criteria'=>'Invoice\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Invoice\ReportModule',
    ];
    
    protected $delete = [
        'logic'=>'DeleteLogic',
        'request'=>'Invoice\DeleteRequest',
    ];
    
    public function cancel(CancelRequest $request, CancelLogic $logic)
    {
        $result = $logic->init($request->allValid());
        return response()->data($result);
    }
    
}
