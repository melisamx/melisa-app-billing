<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentsConceptsTaxes extends DocumentsConceptsTaxesAbstract
{
    
    protected $casts = [
        'base'=>'float',
        'rateOrFee'=>'float',
        'amount'=>'float',
    ];
    
    public function tax()
    {
        return $this->hasOne('App\Billing\Models\Taxes', 'id', 'idTax');
    }
    
    public function action()
    {
        return $this->hasOne('App\Billing\Models\TaxActions', 'id', 'idTaxAction');
    }
    
    public function typeFactor()
    {
        return $this->hasOne('App\Billing\Models\TypesFactor', 'id', 'idTypeFactor');
    }
    
}
