@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Detail Produk - {{ $productData->name }}</div>
        <img src="{{ asset('images/product' . '/' . $productData->file) }}" alt="" class="card-img-top">
        <div class="card-body text-center">
            <p class="card-text">Nama Produk : {{ $productData->name }}</p>
            <p class="card-text">Harga Produk : {{ number_format($productData->price) }}</p>
            <p class="card-text">Stok Produk : {{ $productData->stock }} Item</p>
            <p class="card-text">Deskripsi Produk <br> {{ $productData->description }}</p>
        </div>
    </div>
</div>
@endsection