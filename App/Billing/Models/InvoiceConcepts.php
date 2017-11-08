<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceConcepts extends InvoiceConceptsAbstract
{
    
    protected $casts = [
        'amount'=>'float',
        'unitValue'=>'float',
        'discount'=>'float',
    ];
    
    public function taxes()
    {
        return $this->hasMany('App\Billing\Models\InvoiceConceptsTaxes', 'idInvoiceConcept', 'id');
    }
    
    public function concept()
    {
        return $this->hasOne('App\Billing\Models\Concepts', 'id', 'idConcept');
    }
    
    public function key()
    {
        return $this->hasOne('App\Billing\Models\ConceptKeys', 'id', 'idConceptKey');
    }
    
    public function unit()
    {
        return $this->hasOne('App\Billing\Models\ConceptUnits', 'id', 'idConceptUnit');
    }
    
}
