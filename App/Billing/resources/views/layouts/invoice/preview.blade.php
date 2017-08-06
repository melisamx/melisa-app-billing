@extends('layouts.reports')

@section('head')
<link href="/insurance/css/report.css?v=1.0.0" rel="stylesheet" type="text/css">
<style>
    
</style>
@endsection

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <td width="70%"></td>
                <td width="30%">
                    <table>
                        <tr>
                            <th>Folio</th>
                        </tr>
                        <tr>
                            <td class="empty">Por generar</td>
                        </tr>
                        <tr>
                            <th>Número de factura</th>
                        </tr>
                        <tr>
                            <td class="empty">Por generar</td>
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
                    <td>Lugar de expedición: {{ $report->expeditionPlace }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="title section">Emisor</th>
                </tr>
                <tr>
                    <td colspan="2">Razón social: {{ $report->transmitter->businessName }}</td>
                    <td colspan="2">RFC: {{ $report->transmitter->rfc }}</td>
                </tr>
                <tr>
                    <td colspan="2">Calle y Número: {{ $report->transmitter->address . $report->transmitter->exteriorNumber }}</td>
                    <td>Ciudad: {{ $report->transmitter->country }}</td>
                    <td>Colonia: {{ $report->transmitter->colony }}</td>
                </tr>
                <tr>
                    <td>Delegación: {{ $report->transmitter->municiplaity }}</td>
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
                    <td colspan="2">Calle y Número: {{ $report->receiver->address . $report->receiver->exteriorNumber }}</td>
                    <td>Ciudad: {{ $report->receiver->country }}</td>
                    <td>Colonia: {{ $report->receiver->colony }}</td>
                </tr>
                <tr>
                    <td>Delegación: {{ $report->receiver->municiplaity }}</td>
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
                        <td>Cantidad</td>
                        <td>Unidad de medida</td>
                        <td>Concepto</td>
                        <td>Precio unitario</td>
                        <td>Importe</td>
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
    
    <br>
    
    <div class="row">
        <div class="col-lg-6">
            
        </div>        
        <div class="col-lg-6">
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
</div>
@endsection