<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Http\Requests\Documents\CancelRequest;
use App\Billing\Logics\Documents\CancelLogic;
use App\Billing\Logics\Documents\PdfLogic;
use App\Billing\Logics\Documents\XmlLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DocumentsController extends CrudController
{    
    
    protected $create = [
        'logic'=>'Documents\CreateLogic'
    ];
    
    protected $update = [
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'request'=>'Documents\PagingRequest',
        'criteria'=>'Documents\PagingCriteria'
    ];
    
    protected $report = [
        'logic'=>'ReportLogic',
        'module'=>'Universal\Documents\ReportModule',
    ];
    
    protected $delete = [
        'logic'=>'DeleteLogic',
        'request'=>'Documents\DeleteRequest',
    ];
    
    public function cancel(
        CancelRequest $request, 
        CancelLogic $logic
    )
    {
        $result = $logic->init($request->allValid());
        return response()->data($result);
    }
    
    public function pdf(
        $id, 
        PdfLogic $logic
    )
    {
        $result = $logic->init($id);        
        
        if( !$result) {
            return response()->data(false);
        }
        
        return response()->file($result['path'], $result['headers']);
    }
    
    public function xml(
        $id, 
        XmlLogic $logic
    )
    {
        $result = $logic->init($id);
        
        if( !$result) {
            return response()->data(false);
        }
        
        return response()->file($result['path'], $result['headers']);
    }
    
}
