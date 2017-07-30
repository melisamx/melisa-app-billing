<?php

namespace App\Billing\Interfaces;

/**
 * Default receiver abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ReceiverAbstract implements FormatInterface
{
    
    protected $rfc;
    protected $businessName;
    protected $taxResidence;
    protected $taxIdNumber = '';
    protected $useCfdi = '';
    
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
        return $this;
    }
    
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
        return $this;
    }
    
    public function setTaxResidence($taxResidence)
    {
        $this->taxResidence = $taxResidence;
        return $this;
    }
    
    public function setUseCfdi($useCfdi)
    {
        $this->useCfdi = $useCfdi;
        return $this;
    }
    
}
