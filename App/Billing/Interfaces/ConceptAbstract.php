<?php

namespace App\Billing\Interfaces;

/**
 * Default concept abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ConceptAbstract implements FormatInterface
{
    
    protected $productOrServiceKey;
    protected $numberIdentification;
    protected $quantity;
    protected $unitKey;
    protected $unit;
    protected $description;
    protected $unitValue;
    protected $amount;
    protected $discount = 0;
    
    public function setProductOrServiceKey($productOrServiceKey)
    {
        $this->productOrServiceKey = $productOrServiceKey;
        return $this;
    }
    
    public function setNumberIdentification($numberIdentification)
    {
        $this->numberIdentification = $numberIdentification;
        return $this;
    }
    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    
    public function setUnitKey($unitKey)
    {
        $this->unitKey = $unitKey;
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
    
    public function setUnitValue($unitValue)
    {
        $this->unitValue = $unitValue;
        return $this;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }
    
}
