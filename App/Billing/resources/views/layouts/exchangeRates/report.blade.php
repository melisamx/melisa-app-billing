@extends('layouts.reports')

@section('head')
<link href="/insurance/css/report.css?v=1.0.0" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('partials.exchangeRates.general')
        </div>
    </div>
</div>
@endsection