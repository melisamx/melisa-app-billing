<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\SaveAllUppercaseTrait;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Contributors extends ContributorsAbstract
{
    use SaveAllUppercaseTrait;
    
    protected $noUppercase = [
        'email'
    ];
    
    public function setEmailAttribute($value)
    {
        $this->attributes ['email']= strtolower($value);
    }
    
    public function fiscalRegime()
    {
        return $this->hasOne('App\Billing\Models\FiscalRegime', 'id', 'idFiscalRegime');
    }
    
    public function addresses()
    {
        return $this->hasMany('App\Billing\Models\ContributorsAddresses', 'idContributor', 'id');
    }
    
    public function address()
    {
        return $this->hasOne('App\Billing\Models\ContributorsAddresses', 'idContributor', 'id');
    }
    
}
