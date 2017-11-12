<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Folio="{{ $invoice->folio }}" Serie="{{ $invoice->serie->serie }}" Fecha="{{ $invoice->dateCfdi }}" FormaPago="{{ $invoice->way_topay->key }}" SubTotal="{{ number_format($invoice->subTotal, 2, '.', '') }}" Moneda="{{ $invoice->coin->shortName }}" Total="{{ number_format($invoice->total, 2, '.', '') }}" TipoDeComprobante="{{ $invoice->voucher_type->valueV33 }}" MetodoPago="{{ $invoice->payment_method->key }}" LugarExpedicion="{{ $invoice->transmitter_address->postalCode }}" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
    <cfdi:Emisor Rfc="{{ $invoice->transmitter->rfc }}" Nombre="{{ $invoice->transmitter->name }}" RegimenFiscal="{{ $invoice->transmitter->fiscal_regime->key }}" />
    <cfdi:Receptor Rfc="{{ $invoice->customer->rfc }}" Nombre="{{ $invoice->customer->name }}" UsoCFDI="{{ $invoice->use_cfdi->key }}" />
    <cfdi:Conceptos>
    @foreach($invoice->concepts as $concept)
        <cfdi:Concepto ClaveProdServ="{{ $concept->key->key }}" Cantidad="{{ (int)$concept->quantity }}" ClaveUnidad="{{ $concept->unit->key }}" Descripcion="{{ $concept->description }}" ValorUnitario="{{ number_format($concept->unitValue, 2, '.', '') }}" Importe="{{ number_format($concept->amount, 2, '.', '') }}" Unidad="NO APLICA">
            <cfdi:Impuestos>
                <cfdi:Traslados>@if($invoice->totalTaxTransfer > 0)
                @foreach($invoice->taxes->transfer as $i=>$tax)
                    <cfdi:Traslado Base="{{ number_format($tax->base, 2, '.', '') }}" Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
                @endforeach  
                </cfdi:Traslados>
            @endif
            @if($invoice->totalTaxRetention > 0)
                <cfdi:Retenciones>
                @foreach($invoice->taxes->retention as $i=>$tax)
                    <cfdi:Retencion Base="{{ number_format($tax->base, 2, '.', '') }}" Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
                @endforeach
                </cfdi:Retenciones>
            @endif
            </cfdi:Impuestos>
        </cfdi:Concepto>
    @endforeach
    </cfdi:Conceptos>
    <cfdi:Impuestos TotalImpuestosRetenidos="{{ number_format($invoice->totalTaxRetention, 2, '.', '') }}" TotalImpuestosTrasladados="{{ number_format($invoice->totalTaxTransfer, 2, '.', '') }}">
    @if($invoice->totalTaxRetention > 0)
        <cfdi:Retenciones>
        @foreach($invoice->taxes->retention as $tax)
            <cfdi:Retencion Impuesto="{{ $tax->tax->key }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
        @endforeach
        </cfdi:Retenciones>
    @endif
    @if($invoice->totalTaxTransfer > 0)
        <cfdi:Traslados>
        @foreach($invoice->taxes->transfer as $tax)
            <cfdi:Traslado Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
        @endforeach
        </cfdi:Traslados>
    @endif
    </cfdi:Impuestos>
</cfdi:Comprobante>