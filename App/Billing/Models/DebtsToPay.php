<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DebtsToPay extends DebtsToPayAbstract
{
    
    public function scopeByIdDocument($query, $idDocument)
    {
        return $query->where('idDocument', $idDocument);
    }
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\DebtsToPayStatus', 'id', 'idDebtsToPayStatus');
    }
    
    public function voucher()
    {
        return $this->hasOne('App\Drive\Models\Files', 'id', 'idFileVoucher');
    }
    
    public function filepayment()
    {
        return $this->hasOne('App\Drive\Models\Files', 'id', 'idFilePayment');
    }
    
    public function document()
    {
        return $this->hasOne('App\Billing\Models\Documents', 'id', 'idDocument');
    }
    
    public function provider()
    {
        return $this->hasOne('App\Billing\Models\Providers', 'id', 'idProvider');
    }
    
    public function contributor()
    {
        return $this->hasOne('App\Billing\Models\ContributorsAddresses', 'id', 'idContributorAddress')
            ->join('contributors as c', 'c.id', 'contributorsAddresses.idContributor')
            ->select('c.*');
    }
    
}
