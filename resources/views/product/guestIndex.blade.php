@extends('layouts.app')

@section('title', 'Produk Kami')

@section('content')
@include('layouts.flash')
<div class="container mt-5">
    <div class="row">
        @foreach($allProducts as $product)
        <div class="col-sm-3">
            <div class="card">
                <img src="{{ asset('images/product' . '/' . $product->file) }}" alt="" class="card-img-top">
                <div class="card-body">
                    <p class="card-title">{{ $product->name }}</p>
                    <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{ route('guestProductDetail', ['id' => $product->id]) }}" class="btn btn-success">Detail</a>
                        </div>
                        <div class="col-sm-8">
                            <a href="{{ route('cartUserCreate', ['id' => $product->id]) }}" class="btn btn-primary">+
                                Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
