<?php

namespace App\Billing\Interfaces\Documents\v32;

/**
 * Default concept abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ConceptAbstract
{
    
    protected $quantity;
    protected $unit = 'no aplica';
    protected $description;
    protected $price;
    protected $amount;
    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function getUnit()
    {
        return $this->unit;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function toArray()
    {
        return [
            'quantity'=>$this->getQuantity(),
            'price'=>$this->getPrice(),
            'unit'=>$this->getUnit(),
            'description'=>$this->getDescription(),
            'amount'=>$this->getAmount(),
        ];
    }
    
}
