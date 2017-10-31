<?php

namespace App\Billing\Interfaces\Invoice;

/**
 * Concept tax
 *
 * @author Luis Josafat Heredia Contreras
 */
class ConceptTax
{
    
    protected $tax = 'IVA';
    protected $typeFactor = 'Tasa';
    protected $base;
    protected $amount;
    protected $rateOrFee;
    
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }
    
    public function getTax()
    {
        return $this->tax;
    }
    
    public function setTypeFactor($type)
    {
        $this->typeFactor = $type;
        return $this;
    }
    
    public function getTypeFactor()
    {
        return $this->typeFactor;
    }
    
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }
    
    public function getBase()
    {
        return $this->base;
    }
    
    public function getAmount()
    {
        return $this->amount * $this->rateOrFee;
    }
    
    public function getRateOrFee()
    {
        return $this->rateOrFee;
    }
    
    public function setRateOrFee($rateOrFee)
    {
        $this->rateOrFee = $rateOrFee;
        return $this;
    }
    
}
