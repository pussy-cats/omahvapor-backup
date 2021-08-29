@extends('adminlte::page')

@section('title', 'Daftar Produk')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Produk</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.flash')
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Stok Produk</th>
                            <th scope="col">Deskripsi Produk</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allProducts as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="text-center"><a href="{{ route('productEdit', ['id' => $product->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a href="{{ route('productDelete', ['id' => $product->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4">{{ $allProducts->links() }}</div>
            </div>
        </div>
    </div>
</div>
@stop
