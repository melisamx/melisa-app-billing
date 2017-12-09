<?php

namespace App\Billing\Interfaces\Documents;

/**
 * Transmitter
 *
 * @author Luis Josafat Heredia Contreras
 */
class Transmitter
{
    
    protected $idContributor;
    protected $idContributorAddress;
    protected $idFiscalRegime;
    
    public function setIdContributor($id)
    {
        $this->idContributor = $id;
        return $this;
    }
    
    public function getIdContributor()
    {
        return $this->idContributor;
    }
    
    public function setIdContributorAddress($id)
    {
        $this->idContributorAddress = $id;
        return $this;
    }
    
    public function getIdContributorAddress()
    {
        return $this->idContributorAddress;
    }
    
    public function getIdFiscalRegime()
    {
        return $this->idFiscalRegime;
    }
    
    public function setIdFiscalRegime($id)
    {
        $this->idFiscalRegime = $id;
        return $this;
    }
    
}
