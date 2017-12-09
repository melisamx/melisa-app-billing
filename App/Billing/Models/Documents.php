<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Documents extends DocumentsAbstract
{
    
    protected $casts = [
        'total'=>'float',
        'subTotal'=>'float',
        'totalTaxRetention'=>'float',
        'totalTaxTransfer'=>'float',
    ];
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\DocumentStatus', 'id', 'idDocumentStatus');
    }
    
    public function coin()
    {
        return $this->hasOne('App\Billing\Models\Coins', 'id', 'idCoin');
    }
    
    public function useCfdi()
    {
        return $this->hasOne('App\Billing\Models\UseCfdi', 'id', 'idUseCfdi');
    }
    
    public function customer()
    {
        return $this->hasOne('App\Billing\Models\Customers', 'id', 'idCustomer')
            ->join('contributors as c', 'c.id', '=', 'customers.idContributor')
            ->select([
                'customers.*',
                'c.rfc',
                'c.name',
            ]);
    }
    
    public function customerAddress()
    {
        return $this->hasOne('App\Billing\Models\ContributorsAddresses', 'id', 'idCustomerAddress');
    }
    
    public function transmitter()
    {
        return $this->hasOne('App\Billing\Models\Contributors', 'id', 'idTransmitter');
    }
    
    public function transmitterAddress()
    {
        return $this->hasOne('App\Billing\Models\ContributorsAddresses', 'id', 'idTransmitterAddress');
    }
    
    public function serie()
    {
        return $this->hasOne('App\Billing\Models\Series', 'id', 'idSerie');
    }
    
    public function voucherType()
    {
        return $this->hasOne('App\Billing\Models\VoucherTypes', 'id', 'idVoucherType');
    }
    
    public function paymentMethod()
    {
        return $this->hasOne('App\Billing\Models\PaymentMethods', 'id', 'idPaymentMethod');
    }
    
    public function wayTopay()
    {
        return $this->hasOne('App\Billing\Models\Waytopay', 'id', 'idWaytopay');
    }
    
    public function concepts()
    {
        return $this->hasMany('App\Billing\Models\DocumentsConcepts', 'idDocument', 'id');
    }
    
}
