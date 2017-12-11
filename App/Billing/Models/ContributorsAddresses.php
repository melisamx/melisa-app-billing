<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\SaveAllUppercaseTrait;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ContributorsAddresses extends ContributorsAddressesAbstract
{
    
    use SaveAllUppercaseTrait;
    
    protected $noUppercase = [
        'accountingAccount'
    ];
    
    public function customer()
    {
        return $this->hasOne('App\Billing\Models\Customers', 'idContributor', 'idContributor');
    }
    
    public function country()
    {
        return $this->hasOne('App\People\Models\Countries', 'id', 'idCountry');
    }
    
    public function state()
    {
        return $this->hasOne('App\People\Models\States', 'id', 'idState');
    }
    
    public function municipality()
    {
        return $this->hasOne('App\People\Models\Municipalities', 'id', 'idMunicipality');
    }
    
    public function accountingAccount()
    {
        return $this->hasOne('App\Billing\Models\AccountingAccounts', 'id', 'idAccountingAccount');
    }
    
}
