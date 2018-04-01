<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use Melisa\Laravel\Logics\PagingLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Http\Requests\Reports\BillsPaidRequest;
use App\Billing\Criteria\Reports\BillsPaidCriteria;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ReportsController extends Controller
{
    
    public function billsPaid(
        BillsPaidRequest $request,
        DocumentsRepository $repository,
        BillsPaidCriteria $criteria
    )
    {
        $logic = new PagingLogic(
            $repository,
            $criteria
        );
        $result = $logic->init($request->allValid());
        return response()->paging($result);
    }
    
}
