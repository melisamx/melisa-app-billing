<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Invoice extends InvoiceAbstract
{
    
    public function status()
    {
        return $this->hasOne('App\Billing\Models\InvoiceStatus', 'id', 'idInvoiceStatus');
    }
    
    public function customer()
    {
        return $this->hasOne('App\Billing\Models\Customers', 'id', 'idCustomer');
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
        return $this->hasMany('App\Insurance\Models\InvoiceConcepts', 'idInvoice', 'id');
    }
    
}
