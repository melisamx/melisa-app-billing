<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DebtsToPay extends DebtsToPayAbstract
{
    
    public function account()
    {
        return $this->hasOne('App\Billing\Models\Accounts', 'id', 'idAccount');
    }
    
}
