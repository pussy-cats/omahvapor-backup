@extends('adminlte::page')

@section('title', 'Tambah Produk ke Jadwal')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Produk ke Jadwal -
    {{ \Carbon\Carbon::parse($scheduleData->start_time)->isoFormat('D MMMM YYYY') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cartCreate', ['id' => $scheduleData->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pelanggan</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            value="{{ $scheduleData->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Alamat Pelanggan</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            value="{{ $scheduleData->user->profile->address }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Pilih Produk yang ingin ditambahkan : (Pilih lebih dari
                            satu dengan klik CTRL)</label>
                        <select multiple class="form-control" id="exampleFormControlSelect2" name="products[]">
                            @foreach($allProducts as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="float-right">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
