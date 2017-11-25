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
    
}
