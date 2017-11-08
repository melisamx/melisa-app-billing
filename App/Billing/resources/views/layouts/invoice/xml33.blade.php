<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Folio="{{ $invoice->folio }}" Serie="{{ $invoice->serie->serie }}" Fecha="{{ $invoice->dateCfdi }}" FormaDePago="{{ $invoice->way_topay->key }}" SubTotal="{{ $invoice->subTotal }}" Moneda="{{ $invoice->coin->shortName }}" Total="{{ $invoice->total }}" TipoDeComprobante="{{ $invoice->voucher_type->valueV33 }}" MetodoPago="{{ $invoice->payment_method->key }}" LugarExpedicion="{{ $invoice->transmitter_address->postalCode }}">
    <cfdi:Emisor Rfc="{{ $invoice->transmitter->rfc }}" Nombre="{{ $invoice->transmitter->name }}" RegimenFiscal="{{ $invoice->transmitter->fiscal_regime->key }}" />
    <cfdi:Receptor Rfc="{{ $invoice->customer->rfc }}" Nombre="{{ $invoice->customer->name }}" UsoCFDI="P01" />
    <cfdi:Conceptos>
    @foreach($invoice->concepts as $concept)
        <cfdi:Concepto ClaveProdServ="{{ $concept->key->key }}" Cantidad="{{ $concept->quantity }}" Unidad="{{ $concept->unit->key }}" Descripcion="{{ $concept->description }}" ValorUnitario="{{ $concept->unitValue }}" Importe="{{ $concept->amount }}" />
        <cfdi:Impuestos>
        @if($invoice->concepts->taxes)
            @foreach($invoice->concepts->taxes as $tax)
            
            @endforeach
        @endif
        </cfdi:Impuestos>
    @endforeach
    </cfdi:Conceptos>
    <cfdi:Impuestos TotalImpuestosRetenidos="{{ $invoice->totalTaxRetention }}" TotalImpuestosTrasladados="{{ $invoice->totalTaxTransfer }}">
    @foreach($invoice->taxes as $tax)
        <cfdi:Retenciones>
            <cfdi:Retencion Impuesto="002" Importe="397.20" />
            <cfdi:Retencion Impuesto="001" Importe="372.38" />
        </cfdi:Retenciones>
        <cfdi:Traslados>
            <cfdi:Traslado Impuesto="{{ $tax->type->key }}" tasa="{{ number_format($tax->rateOrFee, 1) }}" Importe="{{ $tax->amount }}" />
        </cfdi:Traslados>
    @endforeach
    </cfdi:Impuestos>
</cfdi:Comprobante>