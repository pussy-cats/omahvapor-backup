@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mb-4">
    <div class="row">
        <div class="col">
            <h5 class="display-5 text-bold my-4">Checkout - {{ $allCarts->count() }} Produk</h5>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCarts as $cart)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ "Rp. " . number_format($cart->product->price) }}</td>
                        <td>{{ $cart->quantity }} Item</td>
                        <td>{{ "Rp. " . number_format($cart->product->price * $cart->quantity) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Total</td>
                        <td>Rp. {{ number_format($totalProductPrice) }}</td>
                        <td>{{ $totalItem }} Item</td>
                        <td>Rp. {{ number_format($totalPrice) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h5 class="display-5 text-bold my-4">Pengiriman</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('checkoutUserCreate') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                            <select class="form-control" id="province">
                                <option>-- Pilih Provinsi --</option>
                                @foreach($provinceRajaOngkir as $province)
                                <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kota</label>
                            <select class="form-control" id="city" name="city">
                                <option>-- Pilih Kota --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kurir</label>
                            <select class="form-control" id="courier" name="courier">
                                <option>-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Layanan Kurir</label>
                            <select class="form-control" id="service" name="deliveryfee">
                                <option>-- Pilih Layanan --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat Lengkap</label>
                    <textarea class="form-control" name="address" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Checkout" class="btn btn-primary float-right">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#province').change(function () {
            var prov = $('#province').val();

            $.ajax({
                type: 'GET',
                url: '/rajaongkir/city/' + prov,
                success: function (data) {
                    $('#city').empty();
                    $.each(data, function (key, value) {
                        $('#city').append('<option value="' + value.city_id + '">' +
                            value.city_name +
                            '</option>');
                    });
                }
            });
        });

        $('#courier').change(function () {
            var courier = $('#courier').val();
            var city = $('#city').val();

            $.ajax({
                type: 'GET',
                url: '/rajaongkir/service/' + city + '/' + courier,
                success: function (data) {
                    $('#service').empty();
                    $.each(data[0].costs, function (key, value) {
                        $('#service').append('<option value="' + value.cost[0]
                            .value + '">' + value.service +
                            ' - Rp. ' + value.cost[0].value + ' - ' +
                            value.cost[0].etd + ' Hari</option>');
                    });
                }
            });
        });
    });

</script>
@endsection
