<?php

namespace App\Billing\Interfaces\Digifact\v32;

use App\Billing\Interfaces\Documents\v32\Documents as InvoiceBase;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Documents
{
    
    protected $documents;

    public function __construct(
        InvoiceBase $documents
    )
    {
        $this->documents = $documents;
    }
    
    public function formatConcepts()
    {
        $concepts = $this->documents->getConcepts();
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
        $taxes = $this->documents->getTaxes();
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
        $receiver = $this->documents->getReceiver();        
        $enviroment = env('DIGIFACT_ENVIROMENT', 'sandbox');
        
        $data = [
            'DatosCFD'=>[
                'FormadePago'=>$this->documents->getMethodPayment(),
                'Moneda'=>$this->documents->getCoin(),
                'Subtotal'=>$this->documents->getSubtotal(),
                'Total'=>$this->documents->getTotal(),
                'Serie'=>$this->documents->getSeries(),
                'TipodeComprobante'=>$this->documents->getVoucherType(),
                'MensajePDF'=>'Hola',
                'LugarDeExpedicion'=>$this->documents->getExpeditionPlace(),
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
