<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Folio="{{ $documents->folio }}" Serie="{{ $documents->serie->serie }}" Fecha="{{ $documents->dateCfdi }}" FormaPago="{{ $documents->way_topay->key }}" SubTotal="{{ number_format($documents->subTotal, 2, '.', '') }}" Moneda="{{ $documents->coin->shortName }}" Total="{{ number_format($documents->total, 2, '.', '') }}" TipoDeComprobante="{{ $documents->voucher_type->valueV33 }}" MetodoPago="{{ $documents->payment_method->key }}" LugarExpedicion="{{ $documents->transmitter_address->postalCode }}" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
    <cfdi:Emisor Rfc="{{ $documents->transmitter->rfc }}" Nombre="{{ $documents->transmitter->name }}" RegimenFiscal="{{ $documents->transmitter->fiscal_regime->key }}" />
    <cfdi:Receptor Rfc="{{ $documents->customer->rfc }}" Nombre="{{ $documents->customer->name }}" UsoCFDI="{{ $documents->use_cfdi->key }}" />
    <cfdi:Conceptos>
    @foreach($documents->concepts as $concept)
        <cfdi:Concepto ClaveProdServ="{{ $concept->key->key }}" Cantidad="{{ (int)$concept->quantity }}" ClaveUnidad="{{ $concept->unit->key }}" Descripcion="{{ $concept->description }}" ValorUnitario="{{ number_format($concept->unitValue, 2, '.', '') }}" Importe="{{ number_format($concept->amount, 2, '.', '') }}" Unidad="NO APLICA">
            <cfdi:Impuestos>
                <cfdi:Traslados>@if($documents->totalTaxTransfer > 0)
                @foreach($documents->taxes->transfer as $i=>$tax)
                    <cfdi:Traslado Base="{{ number_format($tax->base, 2, '.', '') }}" Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
                @endforeach  
                </cfdi:Traslados>
            @endif
            @if($documents->totalTaxRetention > 0)
                <cfdi:Retenciones>
                @foreach($documents->taxes->retention as $i=>$tax)
                    <cfdi:Retencion Base="{{ number_format($tax->base, 2, '.', '') }}" Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
                @endforeach
                </cfdi:Retenciones>
            @endif
            </cfdi:Impuestos>
        </cfdi:Concepto>
    @endforeach
    </cfdi:Conceptos>
    <cfdi:Impuestos{!! !$documents->totalTaxRetention ? '' : ' TotalImpuestosRetenidos="' . number_format($documents->totalTaxRetention, 2, '.', '') . '"' !!} TotalImpuestosTrasladados="{{ number_format($documents->totalTaxTransfer, 2, '.', '') }}">
    @if($documents->totalTaxRetention > 0)
        <cfdi:Retenciones>
        @foreach($documents->taxes->retention as $tax)
            <cfdi:Retencion Impuesto="{{ $tax->tax->key }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
        @endforeach
        </cfdi:Retenciones>
    @endif
    @if($documents->totalTaxTransfer > 0)
        <cfdi:Traslados>
        @foreach($documents->taxes->transfer as $tax)
            <cfdi:Traslado Impuesto="{{ $tax->tax->key }}" TipoFactor="{{ $tax->type_factor->name }}" TasaOCuota="{{ number_format($tax->rateOrFee, 6, '.', '') }}" Importe="{{ number_format($tax->amount, 2, '.', '') }}" />
        @endforeach
        </cfdi:Traslados>
    @endif
    </cfdi:Impuestos>
</cfdi:Comprobante>