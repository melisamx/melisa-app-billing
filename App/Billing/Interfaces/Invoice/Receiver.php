<?php

namespace App\Billing\Interfaces\Documents;

/**
 * Default receiver
 *
 * @author Luis Josafat Heredia Contreras
 */
class Receiver
{
    
    protected $idCustomer;
    protected $idContributorAddress;
    
    public function setIdCustomer($id)
    {
        $this->idCustomer = $id;
        return $this;
    }
    
    public function getIdCustomer()
    {
        return $this->idCustomer;
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
    
}
