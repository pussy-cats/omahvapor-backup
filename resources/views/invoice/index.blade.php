@extends('adminlte::page')

@section('title', 'Lihat Invoice Checkout')

@section('content_header')
<h1 class="m-0 text-dark">Data Invoice Checkout</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm">
                        Invoice Checkout
                    </div>
                    <div class="col-sm">
                        <div class="float-right">Status : Pending</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm">
                        <p class="text-bold">Penjual</p>
                        <p>Nama : OmahVapor</p>
                        <p>Alamat : Colomadu</p>
                        <p>Kode Pos : 57375</p>
                    </div>
                    <div class="col-sm">
                        <p class="text-bold">Pembeli</p>
                        <p>Nama : {{ $checkoutData->schedule->user->name }}</p>
                        <p>Alamat : {{ $checkoutData->schedule->user->profile->address }}</p>
                        <p>Nomor HP : {{ $checkoutData->schedule->user->profile->phone_number }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Jumlah Beli</th>
                            </thead>
                            <tbody>
                                @foreach($checkoutData->carts as $cart)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->price }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
