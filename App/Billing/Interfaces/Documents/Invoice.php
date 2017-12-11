<?php

namespace App\Billing\Interfaces\Documents;

/**
 * Documents interface
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
        $this->taxes = new \stdClass();
        $this->taxes->transfer = 0;
        $this->taxes->retention = 0;
    }
    
    public function getTotalRetention()
    {
        return $this->calculateTotalTax('r');
    }
    
    public function calculateTotalTax($action)
    {
        $concepts = $this->getConcepts();
        $sumTax = 0;
        foreach($concepts as $concept) {
            $taxes = $concept->getTaxes();
            foreach($taxes as $tax) {
                if( $tax->getAction() === $action) {
                    $sumTax += $tax->getAmount();
                }
            }
        }
        
        return $sumTax;
    }
    
    public function getTotalTransfer()
    {
        return $this->calculateTotalTax('t');
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
    
    public function getSubtotal()
    {
        return $this->subtotal;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
    
    public function getTaxes()
    {
        return $this->taxes;
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
        $this->subtotal += $this->calulateSubtotal($concept);
        $this->total = $this->calculateTotal();
        return $this;    
    }
    
    public function calulateSubtotal(Concept $concept)
    {
        return $concept->getQuantity() * $concept->getUnitValue();
    }
    
    public function calculateTotal()
    {
        $concepts = $this->getConcepts();
        $totalTaxRetention = 0;
        $totalTaxTransfer = 0;
        foreach($concepts as $concept) {
            $totalTaxRetention += $concept->getTotalTaxRetention();
            $totalTaxTransfer += $concept->getTotalTaxTransfer();
        }
        if( !$totalTaxRetention) {
            return $this->getSubtotal() + $totalTaxTransfer;
        }
        
        return $this->getSubtotal() - ($totalTaxRetention - $totalTaxTransfer);
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
            'extraData'=>$this->getExtraData(),
            'taxes'=>$this->getTaxes(),
        ];
    }
    
}
