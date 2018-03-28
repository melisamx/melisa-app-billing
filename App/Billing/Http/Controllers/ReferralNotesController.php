<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Http\Requests\ReferralNotes\CancelRequest;
use App\Billing\Logics\ReferralNotes\CancelLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReferralNotesController extends CrudController
{    
    
    protected $create = [
        'logic'=>'CreateLogic'
    ];
    
    protected $update = [
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'request'=>'ReferralNotes\PagingRequest',
        'criteria'=>'ReferralNotes\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\ReferralNotes\ReportModule',
    ];
    
    public function cancel(
        CancelRequest $request, 
        CancelLogic $logic
    )
    {
        $result = $logic->init($request->allValid());
        return response()->data($result);
    }
    
}
