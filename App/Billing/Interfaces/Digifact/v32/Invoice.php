<?php

namespace App\Billing\Interfaces\Digifact\v32;

use App\Billing\Interfaces\Invoice\v32\Invoice as InvoiceBase;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Invoice
{
    
    protected $invoice;

    public function __construct(
        InvoiceBase $invoice
    )
    {
        $this->invoice = $invoice;
    }
    
    public function formatConcepts()
    {
        $concepts = $this->invoice->getConcepts();
        $items = [];
        foreach ($concepts as $concept) {
            $items []= new \soapval('Concepto', 'Concepto', [
                'Cantidad'=>$concept->getQuantity(),
                'Unidad'=>$concept->getUnit(),
                'Descripcion'=>$concept->getDescription(),
                'Precio'=>$concept->getPrice(),
                'Importe'=>$concept->getAmount(),
            ]);
        }
        return $items;
    }
    
    public function formatTaxes()
    {
        $taxes = $this->invoice->getTaxes();
        $items = [];
        foreach($taxes as $tax) {
            $items []= new \soapval('Impuesto', 'Impuesto', [
                'TipoImpuesto'=>$tax->getType(),
                'Tasa'=>$tax->getRate(),
                'Importe'=>$tax->getAmount(),
            ]);
        }
        return $items;
    }
    
    public function format()
    {
        $receiver = $this->invoice->getReceiver();        
        $enviroment = env('DIGIFACT_ENVIROMENT', 'sandbox');
        
        $data = [
            'DatosCFD'=>[
                'FormadePago'=>$this->invoice->getMethodPayment(),
                'Moneda'=>$this->invoice->getCoin(),
                'Subtotal'=>$this->invoice->getSubtotal(),
                'Total'=>$this->invoice->getTotal(),
                'Serie'=>$this->invoice->getSeries(),
                'TipodeComprobante'=>$this->invoice->getVoucherType(),
                'MensajePDF'=>'Hola',
                'LugarDeExpedicion'=>$this->invoice->getExpeditionPlace(),
            ],
            'Receptor'=>[
                'RFC'=>$receiver->getRfc(),
                'RazonSocial'=>$receiver->getBusinessName(),
                'Pais'=>$receiver->getCountry(),
                'Email1'=>'',
            ],
            'Conceptos'=>$this->formatConcepts(),
            'Impuestos'=>$this->formatTaxes()
        ];
        
        if( $enviroment === 'sandbox') {
            $data ['DatosCFD']['Serie']= 'FACT';
            return $data;
        }
        
        return $data;
    }
    
}
