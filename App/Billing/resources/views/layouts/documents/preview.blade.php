@extends('layouts.reports')

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
                        <tr>
                            <th>Uso CFDI</th>
                            <th>Lugar de expedición</th>
                        </tr>
                        <tr>
                            <td>{{ $report->useCfdi->key }} {{ $report->useCfdi->description }}</td>
                            <td>
                                {{ $report->placeExpedition->postalCode }}
                            </td>
                        </tr>
                        <tr>
                            <th>Efecto de comprobante</th>
                            <th>Régimen fiscal</th>
                        </tr>
                        <tr>
                            <td>
                                {{ $report->voucherType->key }} 
                                {{ $report->voucherType->name }}
                            </td>
                            <td>
                                {{ $report->fiscalRegime->key }} 
                                {{ $report->fiscalRegime->name }}
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
                    <td colspan="2">Nombre: {{ $report->receiver->name }}</td>
                    <td colspan="2">RFC: {{ $report->receiver->rfc }}</td>
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
                @foreach($report->concepts as $concept)
                <tr>
                    <td>{{ $concept->key->key }} {{ $concept->key->name }}</td>
                    <td>{{ number_format($concept->quantity, 2) }}</td>
                    <td>{{ $concept->unitKey->key }} {{ $concept->unitKey->name }}</td>
                    <td></td>
                    <td>{{ $concept->concept->name }}</td>
                    <td>{{ number_format($concept->price, 2) }}</td>
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
                                    {{ $tax->action === 't' ? 'TRASLADOS' : 'RETENCIONES' }}
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
                                <td>{{ $tax->display }}</td>
                                <td>{{ $tax->typeFactor }}</td>
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
            @if( isset($report->extraData))
            <table class="table">
                <tr>
                    <td>Amparado por el Certificado No. {{ $report->extraData->certificateApplication->certificate }}</td>
                </tr>
                <tr>
                    <td>No. Guía de Embarque/BL/Pedimento: {{ $report->extraData->document }}</td>
                </tr>
                <tr>
                    <td>
                    @if( $report->extraData->type === 'DE CARGA')
                        {{ $report->extraData->typeLoad->observations }}
                    @endif
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            @endif
            <table class="table">
                <tr>
                    <th>Moneda</th>
                    <th>Forma de pago</th>                    
                </tr>
                <tr>
                    <td>{{ $report->coin->shortName }} {{ $report->coin->name }}</td>
                    <td>{{ $report->wayToPay->key }} {{ $report->wayToPay->name }}</td>
                </tr>
                <tr>
                    <th colspan="2">Método de pago</th>
                </tr>
                <tr>
                    <td>{{ $report->paymentMethod->key }} {{ $report->paymentMethod->description }}</td>
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
                @if( isset($report->taxes->t))
                <tr>
                    <th>
                        {{ $report->taxes->t->display }} {{ number_format($report->taxes->t->rateOrFee, 6) }}%
                    </th>
                    <td class="text-right">{{ number_format($report->taxes->t->amount, 2) }}</td>
                </tr>
                @endif
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
                    <td>{{ $report->totalLetter }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection