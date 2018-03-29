@extends('layouts.reports')

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <td width="40%">
                    <img class="powerbyImage" src="{{ $assets['powerbyImage']['url'] }}" />
                </td>
                <td width="60%">
                    <table class="table">
                        @if( !empty($report->folio))
                        <tr>
                            <th>Folio Fiscal</th>
                            <th>Folio y Serie</th>
                        </tr>
                        <tr>
                            <td>{{ $report->uuid }}</td>
                            <td>
                                {{ $report->folio }} {{ $report->serie->serie }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Uso CFDI</th>
                            <th>Lugar de expedición</th>
                        </tr>
                        <tr>
                            <td>{{ $report->use_cfdi->key }} {{ $report->use_cfdi->description }}</td>
                            <td>
                                {{ $report->transmitter_address->postalCode }}
                            </td>
                        </tr>
                        <tr>
                            <th>Efecto de comprobante</th>
                            <th>Régimen fiscal</th>
                        </tr>
                        <tr>
                            <td>
                                {{ $report->voucher_type->valueV33 }} 
                                {{ $report->voucher_type->name }}
                            </td>
                            <td>
                                {{ $report->transmitter->fiscal_regime->key }} 
                                {{ $report->transmitter->fiscal_regime->name }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </thead>
    </table>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <th colspan="4" class="title section">Emisor</th>
                </tr>
                <tr>
                    <td colspan="2">Nombre: {{ $report->transmitter->name }}</td>
                    <td colspan="2">RFC: {{ $report->transmitter->rfc }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="title section">Receptor</th>
                </tr>
                <tr>
                    <td colspan="2">Nombre: {{ $report->customer->name }}</td>
                    <td colspan="2">RFC: {{ $report->customer->rfc }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead class="title section">
                    <tr>
                        <th>Cve. del producto/servicio</th>
                        <th>Cantidad</th>
                        <th>Clave unidad</th>
                        <th>Unidad</th>
                        <th>Descripción</th>
                        <th>Valor unitario</th>
                        <th>Importe</th>
                        <th>Descuento</th>
                    </tr>
                </thead>
            @php
                $taxesRetent = [];
                $taxesTransfer = [];
            @endphp
                @foreach($report->concepts as $concept)
                <tr>
                    <td>{{ $concept->key->key }} {{ $concept->key->name }}</td>
                    <td>{{ number_format($concept->quantity, 2) }}</td>
                    <td>{{ $concept->unit->key }} {{ $concept->unit->name }}</td>
                    <td></td>
                    <td>{{ $concept->concept->name }}</td>
                    <td>{{ number_format($concept->unitValue, 2) }}</td>
                    <td>{{ number_format($concept->amount, 2) }}</td>
                    <td>{{ number_format($concept->discount, 2) }}</td>
                </tr>
                @if( count($concept->taxes))
                <tr>
                    <td></td>
                    <td colspan="7">
                        <table class="table">
                        @foreach($concept->taxes as $i=>$tax)                            
                            @if($i === 0)
                            <tr>
                                <th colspan="5">
                                    {{ $tax->action->key === 't' ? 'TRASLADOS' : 'RETENCIONES' }}
                                </th>
                            </tr>
                            @endif
                            <tr>
                                <th>Base</th>
                                <th>Impuesto</th>
                                <th>Tipo factor</th>
                                <th>Tasa o cuota</th>
                                <th>Importe</th>
                            </tr>
                            <tr>
                                <td>{{ $tax->base }}</td>
                                <td>{{ $tax->tax->name }}</td>
                                <td>{{ $tax->type_factor->name }}</td>
                                <td>{{ number_format($tax->rateOrFee, 6) }}</td>
                                <td>{{ number_format($tax->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        </table>
                    </td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <table class="table">
                <tr>
                    <th>Moneda</th>
                    <th>Forma de pago</th>                    
                </tr>
                <tr>
                    <td>{{ $report->coin->shortName }} {{ $report->coin->name }}</td>
                    <td>{{ $report->way_topay->key }} {{ $report->way_topay->name }}</td>
                </tr>
                <tr>
                    <th colspan="2">Método de pago</th>
                </tr>
                <tr>
                    <td colspan="2">
                        {{ $report->payment_method->key }} {{ $report->payment_method->description }}
                    </td>
                </tr>
            </table>
        </div>        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <table class="table">
                <tr>
                    <th class="title section">Subtotal</th>
                    <td class="text-right">{{ number_format($report->subTotal, 2) }}</td>
                </tr>
                <tr>
                    <th class="title section" colspan="2">Impuestos trasladados</th>
                </tr>
                @foreach($report->taxes->transfer as $tax)
                <tr>
                    <th>
                        {{ $tax->tax->name }} {{ number_format($tax->rateOrFee, 6) }}%
                    </th>
                    <td class="text-right">{{ number_format($tax->amount, 2) }}</td>
                </tr>
                @endforeach
                @if( !empty($report->taxes->retention))
                <tr>
                    <th class="title section" colspan="2">Impuestos retenidos</th>
                </tr>
                @endif
                @foreach($report->taxes->retention as $tax)
                <tr>
                    <th>
                        {{ $tax->tax->name }} {{ number_format($tax->rateOrFee, 6) }}%
                    </th>
                    <td class="text-right">{{ number_format($tax->amount, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th class="title section">Total</th>
                    <td class="text-right">{{ number_format($report->total, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <table class="table">
                <tr>
                    <th>Total con letra</th>                    
                </tr>
                <tr>
                    <td>{{ $report->totalLetter }}</td>
                </tr>
                <tr>
                    <th class="title section">
                        Cadena original del complemento de certificación digital del SAT
                    </th>
                </tr>
                <tr>
                    <td class="text-center word-break text-small">
                        {{ $report->stringOriginal }}
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        Este documento es una representacion impresa de un CFDI
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div id="qrcode"></div> 
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    new QRCode(document.getElementById('qrcode'), {
        text: "{!! $report->uuid !!}",
        width: 150,
        height: 150,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>
@endsection