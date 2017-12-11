<?php

namespace App\Billing\Interfaces\Documents;

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
    protected $action = 'r';
    
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }
    
    public function getAction()
    {
        return $this->action;
    }
    
    public function setAction($action)
    {
        if( $action === 'r') {
            $this->action = 'r';
        } else {
            $this->action = 't';
        }
        
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
        return $this->base * $this->rateOrFee;
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
    
    public function toArray()
    {
        return [
            'tax'=>$this->getTax(),
            'amount'=>$this->getAmount(),
            'base'=>$this->getBase(),
            'typeFactor'=>$this->getTypeFactor(),
            'rateOrFee'=>$this->getRateOrFee(),
            'action'=>$this->getAction(),
        ];
    }
    
}
