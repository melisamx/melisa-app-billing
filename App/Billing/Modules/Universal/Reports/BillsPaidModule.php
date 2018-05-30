<?php

namespace App\Billing\Modules\Universal\Reports;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BillsPaidModule extends Outbuildings
{
    
    public $event = 'billing.reports.billsPaid.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'billsPaid'=>$this->module('task.billing.reports.billsPaid.paging'),
                ],
                'wrapper'=>[
                    'title'=>'Reporte de facturas pagadas'
                ]
            ]
        ];        
    }
    
}
