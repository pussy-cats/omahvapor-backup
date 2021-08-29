@extends('adminlte::page')

@section('title', 'Bengkel')

@section('content_header')
<h1 class="m-0 text-dark">Detail Jadwal -
    {{ \Carbon\Carbon::parse($scheduleData->start_time)->isoFormat('D MMMM YYYY') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.flash')
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">Detail Jadwal</div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Nama : </td>
                                        <td>{{ $scheduleData->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal : </td>
                                        <td>{{ \Carbon\Carbon::parse($scheduleData->start_time)->isoFormat('D MMMM YYYY') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status : </td>
                                        <td>{{ $scheduleData->status == 1 ? "Selesai" : "Belum Selesai" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi : </td>
                                        <td>{{ $scheduleData->description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><a
                                                href="{{ route('scheduleStatus', ['id' => $scheduleData->id]) }}"
                                                class="btn btn-primary {{ $scheduleData->status == 1 ? 'disabled' : '' }}">Set
                                                Status
                                                Selesai</a></td>
                                        <td class="text-center"><a
                                                href="{{ route('cartAdd', ['id' => $scheduleData->id]) }}"
                                                class="btn btn-secondary {{ $scheduleData->status == 1 ? 'disabled' : '' }}">Tambah
                                                Produk untuk
                                                Jadwal ini</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">Produk untuk Jadwal ini</div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga Produk</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($scheduleCarts->carts as $cart)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>{{ "Rp. " . number_format($cart->product->price) }}</td>
                                            <td>{{ $cart->quantity . " Item"}}</td>
                                            @if($cart->is_paid == 1)
                                            <td>Sudah Dibayar</td>
                                            @else
                                            <td><a href="{{ route('cartDelete', ['id' => $cart->id]) }}"
                                                    class="btn btn-danger">Hapus</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total Harga</td>
                                            <td class="text-center">
                                                {{ "Rp. " . number_format($scheduleCarts->carts->sum('product.price')) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $scheduleCarts->carts->sum('quantity') . " Item"}}
                                            </td>
                                            @if($scheduleCarts->carts->count() >= 1)
                                            <td class="text-center"><a
                                                    href="{{ route('checkoutCart', ['id' => $scheduleData->id]) }}"
                                                    class="btn btn-success">Checkout</a></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
