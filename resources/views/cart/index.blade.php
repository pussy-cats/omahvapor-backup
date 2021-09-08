@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h5 class="display-5 text-bold my-4">Keranjang Belanja - {{ $allCarts->count() }} Produk</h5>
        </div>
        <div class="col-sm-4 text-right">
            <a href="{{ route('checkoutUserAdd') }}" class="btn btn-primary mt-3">Checkout</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('layouts.flash')
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Jumlah Pesan</th>
                        <th scope="col">Total Harga</th>
                        <th class="text-center" scope="col" colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCarts as $cart)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ "Rp." . number_format($cart->product->price) }}</td>
                        <td>{{ $cart->quantity }} Item</td>
                        <td>{{ "Rp." . number_format($cart->product->price * $cart->quantity) }}</td>
                        <td class="text-center"><a href="{{ route('cartEdit', ['id' => $cart->id]) }}"
                                class="btn btn-primary">Edit</a></td>
                        <td class="text-center"><a href="{{ route('cartUserDelete', ['id' => $cart->id]) }}"
                                class="btn btn-danger">Hapus</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
