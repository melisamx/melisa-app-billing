<?php

namespace App\Billing\Interfaces\Invoice;

/**
 * Concept interface
 *
 * @author Luis Josafat Heredia Contreras
 */
class Concept
{
    
    protected $id;
    protected $idConceptKey;
    protected $idConceptUnit;
    protected $quantity;
    protected $unit;
    protected $description;
    protected $price;
    protected $amount;
    protected $discount = 0;
    protected $extraData;
    protected $taxes = [];
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getDiscount()
    {
        return $this->discount;
    }
    
    public function setIdConceptKey($id)
    {
        $this->idConceptKey = $id;
        return $this;
    }
    
    public function getIdConceptKey()
    {
        return $this->idConceptKey;
    }
    
    public function setIdConceptUnit($id)
    {
        $this->idConceptUnit = $id;
        return $this;
    }
    
    public function getIdConceptUnit()
    {
        return $this->idConceptUnit;
    }
    
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
        return $this->quantity * $this->price;
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
    
    public function getExtraData()
    {
        return $this->extraData;
    }
    
    public function setExtraData($data)
    {
        $this->extraData = $data;
    }
    
    public function addTax(ConceptTax $tax)
    {
        $this->taxes []= $tax;
        return $this;
    }
    
    public function getTaxes()
    {
        return $this->taxes;
    }
    
    public function toArray()
    {
        $taxes = $this->getTaxes();
        $arrayTaxes = [];
        foreach($taxes as $tax) {
            $arrayTaxes []= $tax->toArray();
        }
        
        return [
            'id'=>$this->getId(),
            'idConceptKey'=>$this->getIdConceptKey(),
            'idConceptUnit'=>$this->getIdConceptUnit(),
            'quantity'=>$this->getQuantity(),
            'price'=>$this->getPrice(),
            'discount'=>$this->getDiscount(),
            'description'=>$this->getDescription(),
            'amount'=>$this->getAmount(),
            'unit'=>$this->getUnit(),
            'extraData'=>$this->getExtraData(),
            'taxes'=>$arrayTaxes,
        ];
    }
    
}
