@extends('layouts.app')

@section('title', 'Edit Keranjang Belanja')

@section('content')
<div class="container">
    <h5 class="display-5 text-bold my-4">Edit Keranjang Belanja</h5>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('cartUpdate', ['id' => $cartData->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                        value="{{ $cartData->product->name }}" name="name" disabled required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Harga Satuan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                        value="{{ 'Rp. ' . number_format($cartData->product->price) }}" name="price" disabled required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Jumlah Pesan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity"
                        value="{{ $cartData->quantity }}" required>
                </div>
                <div class="form-group float-right">
                    <input class="btn btn-primary" type="submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
