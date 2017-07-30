<?php

namespace App\Billing\Interfaces;

/**
 * Default tax transferred abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class TaxTransferredAbstract implements FormatInterface
{
    
    protected $base;
    protected $tax;
    protected $typeFactor;
    protected $taxShare;
    protected $amount;
    
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }
    
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }
    
    public function setTypeFactor($typeFactor)
    {
        $this->$typeFactor = $typeFactor;
        return $this;
    }
    
    public function setTaxShare($taxShare)
    {
        $this->taxShare = $taxShare;
        return $this;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
}
