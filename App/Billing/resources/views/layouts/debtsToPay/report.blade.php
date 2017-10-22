@extends('layouts.reports')

@section('head')
<style>
    .section
    {
        text-align: center;
    }
    .paid
    {
        background-color: #4CAF50;
        color: #fff;
    }
    .new
    {
        background-color: #607D8B;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table">
                <tr>
                    @if( $report->status->key === 'new')
                    <th class="title section new" colspan="2">
                    @else if($report->status->key === 'paid')
                    <th class="title section paid" colspan="2">
                    @endif
                    Estatus {{ $report->status->name }}
                    </th>
                </tr>
                <tr>
                    <th>Cuenta</th>
                    <th>Monto a pagar</th>
                </tr>
                <tr>
                    <td>{{ $report->account->name }}</td>
                    <td>${{ number_format($report->amountPayable, 2) }}</td>
                </tr>
                <tr>                    
                    <th>Fecha del comprobante</th>
                    <th>Fecha de expiración</th>
                </tr>
                <tr>
                    <td>{{ $report->createdAt }}</td>
                    <td>{{ $report->dueDate }}</td>
                </tr>
                <tr>                    
                    <th colspan="2">Combrobante</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ $modules['filesView'] . $report->idFileVoucher }}" target="__blank">Descargar comprobante</a>
                    </td>
                </tr>
                @if( $report->idFilePayment)
                <tr>                    
                    <th colspan="2">Combrobante de pago</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ $modules['filesView'] . $report->idFilePayment }}" target="__blank">Descargar comprobante</a>
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection