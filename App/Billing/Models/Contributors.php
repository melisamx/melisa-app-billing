<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Contributors extends ContributorsAbstract
{
    
    public function setEmailAttribute($value)
    {
        $this->attributes ['email']= strtolower($value);
    }
    
    public function addresses()
    {
        return $this->hasMany('App\Billing\Models\ContributorsAddresses', 'idContributor', 'id');
    }
}
