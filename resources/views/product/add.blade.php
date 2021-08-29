@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Produk</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('productStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="exampleFormControlInput1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Stock Produk</label>
                            <input type="number" class="form-control" name="stock" id="exampleFormControlInput1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Foto Produk</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="file"
                                    required>
                                <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
                            </div>
                        </div>
                        <div class="text-right"><input type="submit" value="Simpan" class="btn btn-primary"></div>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="application/javascript">
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

</script>
@endsection
