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
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\DebtsToPayStatus', 'id', 'idDebtsToPayStatus');
    }
    
    public function voucher()
    {
        return $this->hasOne('App\Drive\Models\Files', 'id', 'idFileVoucher');
    }
    
    public function invoice()
    {
        return $this->hasOne('App\Billing\Models\Invoice', 'id', 'idInvoice');
    }
    
}
