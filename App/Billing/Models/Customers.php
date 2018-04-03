<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Customers extends CustomersAbstract
{
    
    protected $casts = [
        'quota'=>'float',
    ];

    public function repository()
    {
        return $this->hasOne('App\Billing\Models\Repositories', 'id', 'idRepository');
    }
    
    public function contributor()
    {
        return $this->hasOne('App\Billing\Models\Contributors', 'id', 'idContributor');
    }
    
    public function waytopay()
    {
        return $this->hasOne('App\Billing\Models\Waytopay', 'id', 'idWaytopay');
    }
    
    public function commissionAgents()
    {
        return $this->hasMany('App\Insurance\Models\CustomersCommissionAgents', 'idCustomer', 'id');
    }
    
    public function commissionDealers()
    {
        return $this->hasMany('App\Insurance\Models\CustomersDealers', 'idCustomer', 'id');
    }
    
    public function scopeByIdContributorAddress($query, $idContributorAddress)
    {
        $table = $this->getTable();
        return $query
            ->select([
                "$table.*"
            ])
            ->join('contributors as c', 'c.id', '=', "$table.idContributor")
            ->join('contributorsAddresses as ca', 'ca.idContributor', '=', "ca.id")
            ->where('ca.id', $idContributorAddress);
    }
    
}
