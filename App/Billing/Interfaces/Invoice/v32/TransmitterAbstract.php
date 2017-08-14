<?php

namespace App\Billing\Interfaces\Invoice\v32;

/**
 * Default transmitter abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class TransmitterAbstract
{
    
    protected $rfc;
    protected $businessName;
    protected $country;
    protected $state;
    protected $municipality;
    protected $address;
    protected $colony;
    protected $postalCode;
    protected $exteriorNumber;
    protected $interiorNumber;
    protected $regime;
    
    public function setRegime($regime)
    {
        $this->regime = $regime;
        return $this;
    }
    
    public function getRegime()
    {
        return $this->regime;
    }
    
    public function setInteriorNumber($interiorNumber)
    {
        $this->interiorNumber = $interiorNumber;
        return $this;
    }
    
    public function setExteriorNumber($exteriorNumber)
    {
        $this->exteriorNumber = $exteriorNumber;
        return $this;
    }
    
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }
    
    public function setColony($colony)
    {
        $this->colony = $colony;
        return $this;
    }
    
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
        return $this;
    }
    
    public function getRfc()
    {
        return $this->rfc;
    }
    
    public function getBusinessName()
    {
        return $this->businessName;
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    public function getColony()
    {
        return $this->colony;
    }
    
    public function getPostalCode()
    {
        return $this->postalCode;
    }
    
    public function getMunicipality()
    {
        return $this->municipality;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function getExteriorNumber()
    {
        return $this->exteriorNumber;
    }
    
    public function getInteriorNumber()
    {
        return $this->interiorNumber;
    }
    
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
        return $this;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
    
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
    
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;
        return $this;
    }
    
    public function setAdddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
}
