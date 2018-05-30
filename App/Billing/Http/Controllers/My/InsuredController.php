<?php

namespace App\Billing\Http\Controllers\My;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class InsuredController extends CrudController
{
    
    protected $create = [
        'repository'=>'InsuredRepository',
        'request'=>'My\Insured\CreateRequest',
        'logic'=>'CreateLogic'
    ];
    
    protected $update = [
        'repository'=>'InsuredRepository',
        'logic'=>'UpdateLogic'
    ];
    
    protected $paging = [
        'repository'=>'InsuredRepository',
        'criteria'=>'Insured\PagingCriteria'
    ];
    
    protected $report = [
        'repository'=>'InsuredRepository',
        'logic'=>'ReportLogic',
        'module'=>'Universal\My\Insured\ReportModule',
    ];
    
    protected $delete = [
        'repository'=>'InsuredRepository',
    ];
    
}
