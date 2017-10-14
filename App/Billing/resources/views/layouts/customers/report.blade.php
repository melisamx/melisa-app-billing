@extends('layouts.reports')

@section('head')
<link href="/insurance/css/report.css?v=1.0.0" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('partials.customers.general')
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 class="title section">Comisionistas asociados ({{ count($report->commission_agents) }})</h4>
            @include('partials.customers.commissionAgents', [
                'commissionAgents'=>$report->commission_agents
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 class="title section">Distribudiroes asociados ({{ count($report->commission_dealers) }})</h4>
            @include('partials.customers.commissionDealers', [
                'commissionDealers'=>$report->commission_dealers
            ])
        </div>
    </div>
</div>
@endsection