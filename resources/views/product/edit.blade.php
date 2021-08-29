@extends('adminlte::page')

@section('title', 'Edit Produk - Bengkel')

@section('content_header')
<h1 class="m-0 text-dark">Edit Produk - {{ $product->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('productUpdate', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="exampleFormControlInput1"
                                value="{{ $product->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Stock Produk</label>
                            <input type="number" class="form-control" name="stock" id="exampleFormControlInput1"
                                value="{{ $product->stock }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"
                                required>{{ $product->description }}</textarea>
                        </div>
                        <div class="text-right"><input type="submit" value="Simpan" class="btn btn-primary"></div>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
