<?php

namespace App\Billing\Logics\Documents\Receipt;

use App\Billing\Logics\Documents\CreateLogic as BaseCreateLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.documents.notes.created.success';
    
}
