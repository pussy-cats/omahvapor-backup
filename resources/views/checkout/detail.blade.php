@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Detail Pembelian</h1>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">Detail Pembayaran</div>
                            <div class="card-body">
                                <h3 class="text-center mb-4">Detail Pelanggan</h3>
                                <dl class="row">
                                    <dt class="col-sm-6">Nama Pelanggan</dt>
                                    <dd class="col-sm-6">{{ $checkoutData->user->name }}</dd>
                                    <dt class="col-sm-6">Alamat Pelanggan</dt>
                                    <dd class="col-sm-6">{{ $checkoutData->address }}</dd>
                                </dl>
                                <h3 class="text-center mb-4">Detail Pembelian</h3>
                                <dl class="row">
                                    <dt class="col-sm-6">Jumlah Belanja</dt>
                                    <dd class="col-sm-6">Rp. {{ number_format($checkoutData->total) }}</dd>
                                    <dt class="col-sm-6">Jumlah Biaya Ongkir</dt>
                                    <dd class="col-sm-6">Rp. {{ number_format($checkoutData->deliveryfee) }}</dd>
                                    <dt class="col-sm-6">Total Belanja</dt>
                                    <dd class="col-sm-6">Rp. {{ number_format($checkoutData->deliveryfee + $checkoutData->total) }}</dd>
                                    <dt class="col-sm-6">Kurir Pengiriman</dt>
                                    <dd class="col-sm-6">{{ strtoupper($checkoutData->courier) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">Bukti Pembayaran</div>
                            <img src="{{ asset('images/payments' . '/' . $checkoutData->payment->file) }}" alt="" class="card-img-top">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
