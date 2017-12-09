<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AccountsReceivable extends AccountsReceivableAbstract
{
    
    protected $casts = [
        'totalCharged'=>'float',
        'amountCharged'=>'float',
    ];
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\DebtsToPayStatus', 'id', 'idDebtsToPayStatus');
    }
    
    public function documents()
    {
        return $this->hasOne('App\Billing\Models\Documents', 'id', 'idDocument');
    }
    
}
