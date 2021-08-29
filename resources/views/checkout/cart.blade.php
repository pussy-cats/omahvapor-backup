@extends('adminlte::page')

@section('title', 'Checkout Jadwal')

@section('content_header')
<h1 class="m-0 text-dark">Checkout Jadwal
    {{ \Carbon\Carbon::parse($scheduleData->start_time)->isoFormat('D MMMM YYYY') }} - {{ $scheduleData->user->name }}
</h1>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Nama Produk</td>
                                <td>Harga Satuan Produk</td>
                                <td>Jumlah</td>
                                <td>Harga Total</td>
                            </tr>
                            @foreach($scheduleData->carts as $cart)
                            <tr>
                                <td>{{ $cart->product->name }}</td>
                                <td>{{ "Rp. " . number_format($cart->product->price) }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ "Rp. " . number_format($cart->product->price * $cart->quantity) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">Total</td>
                                <td>{{ $scheduleData->carts->sum('quantity') }} Item</td>
                                <td>{{ "Rp. " . number_format($scheduleData->carts->sum('product.price')) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('checkoutCreate', ['id' => $scheduleData->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="">Total Belanja</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" class="form-control" id="totalPrice"
                                            value="{{ $sumOfTotal }}" name="total" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Bayar</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" class="form-control" id="amountOfPay" name="pay">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Kembali</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" class="form-control" id="amountOfChange" name="change"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="checkoutButton" value="Simpan"
                                class="form-control btn btn-primary float-right mt-4 disabled">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#amountOfPay").change(function () {
            if (parseInt($("#amountOfPay").val()) >= parseInt($("#totalPrice").val())) {
                $("#amountOfChange").val(parseInt($("#amountOfPay").val()) - parseInt($("#totalPrice")
                    .val()))
                $("#checkoutButton").removeClass("disabled")
            } else {
                $("#amountOfChange").val("Uang kurang")
                $("#checkoutButton").addClass("disabled")
            }
        })
    })

</script>
@stop
