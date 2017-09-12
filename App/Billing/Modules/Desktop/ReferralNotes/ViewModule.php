<?php

namespace App\Billing\Modules\Desktop\ReferralNotes;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ViewModule extends Outbuildings
{
    
    public $event = 'billing.referralNotes.view.access';

    public function dataDictionary()
    {        
        return [
            'success'=>true,
            'data'=>[
                'token'=>csrf_token(),
                'modules'=>[
                    'referralNotes'=>$this->module('task.billing.referralNotes.paging'),
                    'report'=>$this->module('task.billing.referralNotes.report'),
                    'cancel'=>$this->module('task.billing.referralNotes.cancel', false),
                ],
                'wrapper'=>[
                    'title'=>'Notas de remisión'
                ]
            ]
        ];        
    }
    
}
