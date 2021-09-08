@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Pembayaran - Checkout Kode : {{ $checkoutData->id }}</div>
        <div class="card-body">
            <form action="{{ route('createPayment', ['id' => $checkoutData->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Nominal Bayar</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" value="Rp. {{ number_format($checkoutData->total + $checkoutData->deliveryfee) }}" readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Pilih Bank : </label>
    <select class="form-control" id="exampleFormControlSelect1" name="bank">
        <option value="BRI">BRI</option>
        <option value="BCA">BCA</option>
        <option value="BNI">BNI</option>
        <option value="MANDIRI">MANDIRI</option>
    </select>
  </div>
  <div class="form-group">
      <label for="">Upload Bukti Transfer : </label>
  <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
  </div>
  <input type="submit" value="Simpan" class="btn btn-primary float-right">
</form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $('#validatedCustomFile').change(function(){
        fileName = this.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
@endsection