<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class BankAccounts extends BankAccountsAbstract
{
    
    public function bank()
    {
        return $this->hasOne('App\Billing\Models\Banks', 'id', 'idBank');
    }
    
}
