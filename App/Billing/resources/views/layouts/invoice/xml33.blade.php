<?xml version="1.0" encoding="utf-8"?>
@php
$transmitter = $invoice->getTransmitter();
$receiver = $invoice->getReceiver();
$totalTax = 0;
foreach($invoice->getTaxes() as $tax) {
    $totalTax += $tax->getAmount(); 
}
@endphp
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Folio="{{ $invoice->getFolio() }}" Serie="{{ $invoice->getSeries() }}" Fecha="{{ $invoice->getDate() }}" formaDePago="Efectivo" SubTotal="{{ $invoice->getSubTotal() }}" Moneda="MXN" Total="{{ $invoice->getTotal() }}" TipoDeComprobante="I" MetodoPago="PUE" LugarExpedicion="{{ $invoice->getExpeditionPlace() }}">
    <cfdi:Emisor Rfc="{{ $transmitter->getRfc() }}" Nombre="{{ $transmitter->getBusinessName() }}" RegimenFiscal="{{ $transmitter->getRegime() }}" />
    <cfdi:Receptor Rfc="{{ $receiver->getRfc() }}" Nombre="{{ $receiver->getBusinessName() }}" UsoCFDI="P01" />
    <cfdi:Conceptos>
    @foreach($invoice->getConcepts() as $concept)
        <cfdi:Concepto ClaveProdServ="{{ $concept->productKey }}" Cantidad="{{ $concept->getQuantity() }}" Unidad="{{ $concept->getUnit() }}" Descripcion="{{ $concept->getDescription() }}" ValorUnitario="{{ $concept->getPrice() }}" Importe="{{ $concept->getAmount() }}" />
    @endforeach
    </cfdi:Conceptos>
    <cfdi:Impuestos totalImpuestosTrasladados="{{ $totalTax }}">
    @foreach($invoice->getTaxes() as $tax)
        <cfdi:Traslados>
            <cfdi:Traslado Impuesto="{{ $tax->getType() }}" tasa="{{ number_format($tax->getRate(), 1) }}" Importe="{{ $tax->getAmount() }}" />
        </cfdi:Traslados>
    @endforeach
    </cfdi:Impuestos>
</cfdi:Comprobante>