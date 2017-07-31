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
//            $items []= [
                'Cantidad'=>$concept->getQuantity(),
                'Unidad'=>$concept->getUnit(),
                'Descripcion'=>$concept->getDescription(),
                'Precio'=>$concept->getPrice(),
                'Importe'=>$concept->getAmount(),
            ]);            
//            ];
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
        return $this->example();
        return [
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
    }
    
    public function example()
    {
        $data = array();
        $data['DatosCFD'] = array();
        $data['DatosCFD']['FormadePago'] = "Pago en una sola exhibicion";
        $data['DatosCFD']['Moneda'] = "MXP";
        $data['DatosCFD']['Subtotal'] = 288035.92;
        $data['DatosCFD']['Total'] = 334121.66;
        $data['DatosCFD']['Serie'] = "A";
        $data['DatosCFD']['TipodeComprobante'] = "F";
        $data['DatosCFD']['MensajePDF'] = "Hola";
        $data['DatosCFD']['LugarDeExpedicion'] = "Mexico DF";

        $data['Receptor'] = array();
        $data['Receptor']['RFC'] = "RFCFALSO1231";
        $data['Receptor']['RazonSocial'] = "DEMODEMO";
        $data['Receptor']['Pais'] = "MEXICO";
        $data['Receptor']['Email1'] = "";

        $conceptosDatos = [
            [
                'Cantidad' => 36.76,
                'Unidad' =>'Piezas',
                'Descripcion' => "Plimas",
                'Precio' => 7835.58,
                'Importe' => 288035.92
            ]
        ];
        
        foreach ($conceptosDatos as $concepto) {
            $data['Conceptos'][] = new \soapval('Concepto', 'Concepto', $concepto);
        }
        // Impuestos
        $impuestosDatos = [[ 'TipoImpuesto' => "IVA", 'Tasa' => 16, 'Importe' => 46085.74 ]];
        foreach ($impuestosDatos as $impuesto) {
            $data['Impuestos'][] = new \soapval('Impuesto', 'Impuesto', $impuesto);
        }
//        dd($data);
        $data['XMLAddenda'] = "";
        $data['Usuario'] = "demo1@sicofi.com.mx";
        $data['Contrasena'] = "demodemoD";
        return $data;
    }
    
}
