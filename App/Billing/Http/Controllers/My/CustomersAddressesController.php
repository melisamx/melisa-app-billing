<?php

namespace App\Billing\Http\Controllers\My;

use Melisa\Laravel\Http\Controllers\CrudController;
use App\Billing\Logics\CustomersAddresses\DeleteLogic;
use App\Billing\Http\Requests\CustomersAddresses\DeleteRequest;
use App\Billing\Logics\CustomersAddresses\UpdateLogic;
use App\Billing\Http\Requests\CustomersAddresses\UpdateRequest;
use App\Billing\Logics\CustomersAddresses\ReportLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CustomersAddressesController extends CrudController
{
    
    protected $create = [
        'logic'=>'CreateLogic',
        'request'=>'CustomersAddresses\CreateRequest',
        'repository'=>'ContributorsAddressesRepository'
    ];
    
    protected $paging = [
        'request'=>'CustomersAddresses\PagingRequest',
        'repository'=>'ContributorsAddressesRepository',
        'criteria'=>'My\CustomersAddresses\PagingCriteria'
    ];    
        
    protected $update = [
        'event'=>'billing.customers.update.success',
        'request'=>'CustomersAddresses\UpdateRequest'
    ];
    
    protected $activate = [
        'event'=>'billing.customers.activate.success',
        'request'=>'CustomersAddresses\ActivateDeactivateRequest'
    ];
    
    protected $deactivate = [
        'event'=>'billing.customers.deactivate.success',
        'request'=>'CustomersAddresses\ActivateDeactivateRequest'
    ];
    
    public function delete()
    {
        $request = app(DeleteRequest::class);
        $logic = app(DeleteLogic::class);
        return response()->data($logic->init($request->allValid()));
    }
    
    public function update()
    {
        $request = app(UpdateRequest::class);
        $logic = app(UpdateLogic::class);
        return response()->data($logic->init($request->allValid()));
    }
    
    public function report($id, $format = 'json')
    {
        return response()->data(app(ReportLogic::class)->init($id));
    }
    
}
