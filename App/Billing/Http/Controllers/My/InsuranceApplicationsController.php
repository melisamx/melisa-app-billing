<?php

namespace App\Billing\Http\Controllers\My;

use Melisa\Laravel\Http\Controllers\Controller;
use Melisa\Laravel\Logics\PagingLogics;

use App\Billing\Http\Requests\My\InsuranceApplications\PagingRequest;
use App\Billing\Http\Requests\My\InsuranceApplications\CreateRequest;
use App\Billing\Http\Requests\My\InsuranceApplications\UpdateRequest;
use App\Billing\Http\Requests\My\InsuranceApplications\DeleteRequest;

use App\Billing\Repositories\InsuranceApplicationsRepository;
use App\Billing\Criteria\My\InsuranceApplications\PagingCriteria;
use App\Billing\Logics\My\InsuranceApplications\CreateLogic;
use App\Billing\Logics\My\InsuranceApplications\UpdateLogic;
use App\Billing\Logics\My\InsuranceApplications\ReportLogic;
use App\Billing\Logics\My\InsuranceApplications\DeleteLogic;
use App\Billing\Modules\Universal\My\InsuranceApplications\ReportModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class InsuranceApplicationsController extends Controller
{
    
    public function paging(PagingRequest $request, InsuranceApplicationsRepository $repository, PagingCriteria $criteria)
    {        
        $logic = new PagingLogics($repository, $criteria);        
        return $logic->init($request->allValid());        
    }
    
    public function update(UpdateRequest $request, UpdateLogic $logic)
    {
        $result = $logic->init($request->allValid());        
        return response()->data($result);        
    }
    
    public function create(CreateRequest $request, CreateLogic $logic)
    {
        $result = $logic->init($request->allValid());        
        return response()->data($result);        
    }
    
    public function delete(DeleteRequest $request, DeleteLogic $logic)
    {
        $result = $logic->init($request->allValid());        
        return response()->data($result);        
    }
    
    public function report($id, $format, ReportModule $module, ReportLogic $logic)
    {        
        if( $format === 'json') {
            return response()->data($logic->init($id));
        }
        
        return $module
            ->withInput($logic->init($id))
            ->render($id);        
    }
    
}
