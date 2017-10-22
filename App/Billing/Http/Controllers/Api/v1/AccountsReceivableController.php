<?php

namespace App\Billing\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Billing\Logics\AccountsReceivable\AutoRegisterLogic;
use App\Billing\Http\Requests\AccountsReceivable\AutoRegisterRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AccountsReceivableController extends Controller
{

    public function autoregister(
        AutoRegisterLogic $logic,
        AutoRegisterRequest $request
    )
    {
        return response()->data($logic->init($request->allValid()));
    }
    
}
