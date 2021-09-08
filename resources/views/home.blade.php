@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <h4>Jumlah User Baru Hari Ini</h4>
                                <h5>{{ $userToday }} User</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <h4>Jumlah Pendapatan Hari ini</h4>
                                <h5>{{ "Rp. " . number_format(1000000) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">Grafik Jumlah User Per Minggu Ini</div>
                            <div class="card-body">
                                {!! $userChart->render() !!}
                            </div>
                            </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">Grafik Jumlah Pendapatan Per Minggu Ini</div>
                            <div class="card-body">
                                <canvas id="saleChart" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
