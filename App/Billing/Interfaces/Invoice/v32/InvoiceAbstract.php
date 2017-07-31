<?php

namespace App\Billing\Interfaces\Invoice\v32;

/**
 * Invoice abstract class
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceAbstract
{
    
    protected $methodPayment = 'Pago en una sola exhibicion';
    protected $folio;
    protected $date;
    protected $subtotal = 0;
    protected $total = 0;
    protected $series;
    protected $voucherType = 'F';
    protected $expeditionPlace;
    protected $discount = 0;
    protected $coin = 'MXN';
    protected $exchangeRate = 0;
    protected $concepts = [];
    protected $taxes = [];
    protected $receiver;

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
    
    public function getFolio()
    {
        return $this->folio;
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
    
    public function getMethodPayment()
    {
        return $this->methodPayment;
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
    
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }
    
    public function getSeries()
    {
        return $this->series;
    }
    
    public function setVoucherType($voucherType)
    {
        $this->voucherType = $voucherType;
        return $this;
    }
    
    public function getVoucherType()
    {
        return $this->voucherType;
    }
    
    public function setExpeditionPlace($expeditionPlace)
    {
        $this->expeditionPlace = $expeditionPlace;
        return $this;
    }
    
    public function getExpeditionPlace()
    {
        return $this->expeditionPlace;
    }
    
    public function setCoin($coin = 'MXN')
    {
        $this->coin = $coin;
        return $this;
    }
    
    public function getCoin()
    {
        return $this->coin;
    }
    
    public function getReceiver()
    {
        return $this->receiver;
    }
    
    public function addConcept(ConceptAbstract $concept)
    {
        $this->concepts []= $concept;
        return $this;    
    }
    
    public function addTax(TaxAbstract $tax)
    {
        $this->taxes []= $tax;
        return $this;
    }
    
    public function getConcepts()
    {
        return $this->concepts;
    }
    
    public function getTaxes()
    {
        return $this->taxes;
    }
    
}
