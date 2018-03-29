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
    
    public function scopeByIdDocument($query, $idDocument)
    {
        return $query->where('idDocument', $idDocument);
    }
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\DebtsToPayStatus', 'id', 'idDebtsToPayStatus');
    }
    
    public function document()
    {
        return $this->hasOne('App\Billing\Models\Documents', 'id', 'idDocument');
    }
    
}
