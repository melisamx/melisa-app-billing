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
                            <th width="50%">Factura Número</th>                            
                            <th width="50%">Folio Fiscal</th>                            
                        </tr>
                        <tr>
                            @if( isset($report->uuid))
                            <td>{{ $report->serie . ' '. $report->folio }}</td>
                            @else
                            <td class="empty">Por generar</td>
                            @endif
                            @if( isset($report->uuid))
                            <td>{{ $report->uuid }}</td>
                            @else
                            <td class="empty">Por generar</td>
                            @endif
                        </tr>
                        <tr>
                            <th>No. de serie del CSD del emisor</th>
                            <th>Fecha y Hora de emisión</th>
                        </tr>
                        <tr>
                            @if( isset($report->numberCertificateSat))
                            <td>{{ $report->numberCertificateSat }}</td>
                            @else
                            <td class="empty">Por generar</td>
                            @endif
                            @if( isset($report->date))
                            <td>{{ $report->date }}</td>
                            @else
                            <td class="empty">Por generar</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Forma de Pago</th>
                            <th>Lugar de expedición</th>
                        </tr>
                        <tr>
                            <td>{{ $report->methodPayment }}</td>
                            <td>{{ $report->expeditionPlace }}</td>
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
                    <td colspan="2">Razón social: {{ $report->transmitter->businessName }}</td>
                    <td colspan="2">RFC: {{ $report->transmitter->rfc }}</td>
                </tr>
                <tr>
                    <td colspan="2">Calle y Número: {{ $report->transmitter->address . ' ' . $report->transmitter->exteriorNumber }}</td>
                    <td>Ciudad: {{ $report->transmitter->country }}</td>
                    <td>Colonia: {{ $report->transmitter->colony }}</td>
                </tr>
                <tr>
                    <td>Delegación: {{ $report->transmitter->municipality }}</td>
                    <td>Estado: {{ $report->transmitter->country }}</td>
                    <td>CP: {{ $report->transmitter->postalCode }}</td>
                    <td>Pais: {{ $report->transmitter->country }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="title section">Receptor</th>
                </tr>
                <tr>
                    <td colspan="2">Razón social: {{ $report->receiver->businessName }}</td>
                    <td colspan="2">RFC: {{ $report->receiver->rfc }}</td>
                </tr>
                <tr>
                    <td colspan="2">Calle y Número: {{ $report->receiver->address . ' ' . $report->receiver->exteriorNumber }}</td>
                    <td>Ciudad: {{ $report->receiver->country }}</td>
                    <td>Colonia: {{ $report->receiver->colony }}</td>
                </tr>
                <tr>
                    <td>Delegación: {{ $report->receiver->municipality }}</td>
                    <td>Estado: {{ $report->receiver->country }}</td>
                    <td>CP: {{ $report->receiver->postalCode }}</td>
                    <td>Pais: {{ $report->receiver->country }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead class="title section">
                    <tr>
                        <th>Cantidad</td>
                        <th>Unidad de medida</td>
                        <th>Concepto</td>
                        <th>Precio unitario</td>
                        <th>Importe</td>
                    </tr>
                </thead>
                @foreach($report->concepts as $concept)
                <tr>
                    <td>{{ number_format($concept->quantity, 2) }}</td>
                    <td>{{ $concept->unit }}</td>
                    <td>{{ $concept->description }}</td>
                    <td>{{ number_format($concept->price, 2) }}</td>
                    <td>{{ number_format($concept->amount, 2) }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            
        </div>        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <table class="table">
                <tr>
                    <th class="title section">Subtotal</th>
                    <td class="text-right">{{ number_format($report->subTotal, 2) }}</td>
                </tr>
                @foreach($report->taxes as $tax)
                <tr>
                    <th class="title section">{{ $tax->type }}</th>
                    <td class="text-right">{{ number_format($tax->amount, 2) }} {{ $report->coin }}</td>
                </tr>
                @endforeach
                <tr>
                    <th class="title section">Total</th>
                    <td class="text-right">{{ number_format($report->total, 2) }} {{ $report->coin }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <table class="table">
                <tr>
                    <th class="title section">Total en letra</th>                    
                </tr>
                <tr>
                    <td>{{ $report->totalLetter }}</td>
                </tr>
                <tr>
                    <th class="title section">Cadena original del complemento de certificación digital del SAT</th>
                </tr>
                <tr>
                    @if( isset($report->stringOriginal))
                    <td class="text-center word-break text-small">{{ $report->stringOriginal }}</td>
                    @else
                    <td class="empty">Por generar</td>
                    @endif
                </tr>
                <tr>
                    <th class="title section">Sello digital del emisor</th>
                </tr>
            </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if( isset($report->uuid))
            <div id="qrcode"></div> 
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    @if( isset($report->sealCfd))
                    <td class="text-center word-break text-small">{{ $report->sealCfd }}</td>
                    @else
                    <td class="empty">Por generar</td>
                    @endif
                </tr>
                <tr>
                    <th class="title section">Sello digital del SAT</th>
                </tr>
                <tr>
                    @if( isset($report->sealSat))
                    <td class="text-center word-break text-small">{{ $report->sealSat }}</td>
                    @else
                    <td class="empty">Por generar</td>
                    @endif
                </tr>
                <tr>
                    <td class="text-center">Este documento es una representacion impresa de un CFDI</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@if( isset($report->uuid))
<script>
    var qrcode = new QRCode(document.getElementById('qrcode'), {
        text: "{!! $report->uuid !!}",
        width: 150,
        height: 150,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>
@endif
@endsection