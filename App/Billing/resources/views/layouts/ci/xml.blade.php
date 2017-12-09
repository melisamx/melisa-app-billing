<?xml version="1.0" encoding="utf-8"?>
@php
$transmitter = $documents->getTransmitter();
$receiver = $documents->getReceiver();
$totalTax = 0;
foreach($documents->getTaxes() as $tax) {
    $totalTax += $tax->getAmount(); 
}
@endphp
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="3.2" folio="{{ $documents->getFolio() }}" serie="{{ $documents->getSeries() }}" fecha="{{ $documents->getDate() }}" formaDePago="Efectivo" subTotal="{{ $documents->getSubTotal() }}" Moneda="MXN" total="{{ $documents->getTotal() }}" tipoDeComprobante="ingreso" metodoDePago="Efectivo" LugarExpedicion="{{ $documents->getExpeditionPlace() }}">
    <cfdi:Emisor rfc="{{ $transmitter->getRfc() }}" nombre="{{ $transmitter->getBusinessName() }}">
        <cfdi:DomicilioFiscal calle="{{ $transmitter->getAddress() }}" noExterior="{{ $transmitter->getExteriorNumber() }}" colonia="{{ $transmitter->getColony() }}" localidad="{{ $transmitter->getMunicipality() }}" municipio="{{ $transmitter->getMunicipality() }}" estado="{{ $transmitter->getState() }}" pais="{{ $transmitter->getCountry() }}" codigoPostal="{{ $transmitter->getPostalCode() }}" />
        <cfdi:RegimenFiscal Regimen="{{ $transmitter->getRegime() }}" />
    </cfdi:Emisor>
    <cfdi:Receptor rfc="{{ $receiver->getRfc() }}" nombre="{{ $receiver->getBusinessName() }}">
        <cfdi:Domicilio calle="{{ $receiver->getAddress() }}" noExterior="{{ $receiver->getExteriorNumber() }}"{!! $receiver->getInteriorNumber() ? (' noInterior="' . $receiver->getInteriorNumber() . '" ') : ' ' !!}colonia="{{ $receiver->getColony() }}" municipio="{{ $receiver->getMunicipality() }}" estado="{{ $receiver->getState() }}" pais="{{ $receiver->getCountry() }}" codigoPostal="{{ $receiver->getPostalCode() }}" />
    </cfdi:Receptor>
    <cfdi:Conceptos>
    @foreach($documents->getConcepts() as $concept)
        <cfdi:Concepto cantidad="{{ $concept->getQuantity() }}" unidad="{{ $concept->getUnit() }}" descripcion="{{ $concept->getDescription() }}" valorUnitario="{{ $concept->getPrice() }}" importe="{{ $concept->getAmount() }}" />
    @endforeach
    </cfdi:Conceptos>
    <cfdi:Impuestos totalImpuestosTrasladados="{{ $totalTax }}">
    @foreach($documents->getTaxes() as $tax)
        <cfdi:Traslados>
            <cfdi:Traslado impuesto="{{ $tax->getType() }}" tasa="{{ number_format($tax->getRate(), 1) }}" importe="{{ $tax->getAmount() }}" />
        </cfdi:Traslados>
    @endforeach
    </cfdi:Impuestos>
</cfdi:Comprobante>