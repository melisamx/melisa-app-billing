<?php

namespace App\Billing\Interfaces\Invoice\v32;

/**
 * Default tax abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class TaxAbstract
{
    
    protected $type;
    protected $rate;
    protected $amount;
    
    public function setType($type)
    {
        if( !in_array($type, [
            'IVA', 'IEPS', 'IVAR', 'ISR'
        ])) {
            dd('tax type invalid');
        }
        
        $this->type = $type;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function getRate()
    {
        return $this->rate;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
    
    public function toArray()
    {
        return [
            'type'=>$this->getType(),
            'rate'=>$this->getRate(),
            'amount'=>$this->getAmount(),
        ];
    }
    
}
