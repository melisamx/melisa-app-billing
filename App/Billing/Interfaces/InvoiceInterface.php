<?php

namespace App\Billing\Interfaces;

/**
 * Documents abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceInterface
{
    
    protected $methodPayment = 'PUE';
    protected $folio;
    protected $paymentConditions = '';
    protected $date;
    protected $subtotal = 0;
    protected $total = 0;
    protected $series;
    protected $voucherType = 'FA';
    protected $expeditionPlace;
    protected $discount = 0;
    protected $coin = 'MXN';
    protected $exchangeRate = 0;
    protected $itemsConcepts = [];
    protected $receiver;
    protected $itemsTaxTransferred = [];
    protected $itemsTaxDetained = [];

    public function __construct(
        ReceiverAbstract $receiver
    )
    {
        $this->receiver = $receiver;
    }
    
    public function setFolio($folio)
    {
        $this->folio = $folio;
        return $this;
    }
    
    public function setPaymentConditions($paymentConditions)
    {
        $this->paymentConditions = $paymentConditions;
        return $this;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    
    public function setMethodPayment($methodPayment = 'PUE')
    {
        $this->methodPayment = $methodPayment;
        return $this;
    }
    
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
        return $this;
    }
    
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
    
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }
    
    public function setVoucherType($voucherType = 'FA')
    {
        $this->voucherType = $voucherType;
        return $this;
    }
    
    public function setExpeditionPlace($expeditionPlace)
    {
        $this->expeditionPlace = $expeditionPlace;
        return $this;
    }
    
    public function setCoin($coin = 'MXN')
    {
        $this->coin = $coin;
        return $this;
    }
    
    public function getReceiver()
    {
        return $this->receiver->format();
    }
    
    public function addConcept(ConceptAbstract $concept)
    {
        $this->itemsConcepts []= $concept;
        return $this;    
    }
    
    public function addTaxTransfer(TaxTransferAbstract $tax)
    {
        $this->itemsTaxTransferred []= $tax;
        return $this;
    }
    
    public function addTaxRetention(TaxRetentionAbstract $tax)
    {
        $this->itemsTaxDetained []= $tax;
        return $this;
    }
    
    public function getConcepts()
    {
        $items = [];
        foreach($this->itemsConcepts as $concept) {
            $items []= $concept->format();
        }
        return $items;
    }
    
    public function getTaxTransferred()
    {
        $items = [];
        foreach($this->itemsTaxTransferred as $tax) {
            $items []= $tax->format();
        }
        return $items;
    }
    
    public function getTaxDetained()
    {
        $items = [];
        foreach($this->itemsTaxDetained as $tax) {
            $items []= $tax->format();
        }
        return $items;
    }
    
}
