<?php

namespace App\Billing\Interfaces\Invoice;

/**
 * Invoice interface
 *
 * @author Luis Josafat Heredia Contreras
 */
class Invoice
{
    
    protected $idSerie;
    protected $idCsd;
    protected $idUseCfdi;
    protected $idVoucherType;
    protected $idCoin;
    protected $idPaymentMethod;
    protected $receiver;
    protected $transmitter;
    protected $voucherType;
    protected $subtotal = 0;
    protected $total = 0;
    protected $extraData;
    protected $concepts = [];
    protected $version = '3.3';

    public function __construct(
        Receiver $receiver,
        Transmitter $transmitter
    )
    {
        $this->receiver = $receiver;
        $this->transmitter = $transmitter;
    }
    
    public function getVersion()
    {
        return $this->version;
    }
    
    public function getReceiver()
    {
        return $this->receiver;
    }
    
    public function getTransmitter()
    {
        return $this->transmitter;
    }
    
    public function setIdPaymentMethod($id)
    {
        $this->idPaymentMethod = $id;
        return $this;
    }
    
    public function setIdCoin($id)
    {
        $this->idCoin = $id;
        return $this;
    }
    
    public function setIdSerie($id)
    {
        $this->idSerie = $id;
        return $this;
    }
    
    public function setIdUseCfdi($id)
    {
        $this->idUseCfdi = $id;
        return $this;
    }
    
    public function getIdUseCfdi()
    {
        return $this->idUseCfdi;
    }
    
    public function getIdPaymentMethod()
    {
        return $this->idPaymentMethod;
    }
    
    public function getIdCoin()
    {
        return $this->idCoin;
    }
    
    public function getIdSerie()
    {
        return $this->idSerie;
    }
    
    public function getIdVoucherType()
    {
        return $this->idVoucherType;
    }
    
    public function setIdVoucherType($id)
    {
        $this->idVoucherType = $id;
        return $this;
    }
    
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
        return $this;
    }
    
    public function getSubtotal()
    {
        return $this->subtotal;
    }
    
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
    
    public function getExtraData()
    {
        return $this->extraData;
    }
    
    public function setExtraData($data)
    {
        $this->extraData = $data;
        return $this;
    }
    
    public function addConcept(Concept $concept)
    {
        $this->concepts []= $concept;
        return $this;    
    }
    
    public function getConcepts()
    {
        return $this->concepts;
    }
    
    public function toArray()
    {
        $concepts = $this->getConcepts();
        $arrayConcepts = [];
        
        foreach($concepts as $concept) {
            $arrayConcepts []= $concept->toArray();
        }
        
        return [
            'idCustomer'=>$this->getReceiver()->getIdCustomer(),
            'idCustomerAddress'=>$this->getReceiver()->getIdContributorAddress(),
            'idTransmitter'=>$this->getTransmitter()->getIdContributor(),
            'idTransmitterAddress'=>$this->getTransmitter()->getIdContributorAddress(),
            'idCoin'=>$this->getIdCoin(),
            'total'=>$this->getTotal(),
            'subtotal'=>$this->getSubtotal(),
            'version'=>$this->getVersion(),
            'concepts'=>$arrayConcepts,
            'extraData'=>$this->getExtraData()
        ];
    }
    
}
