@extends('adminlte::page')

@section('title', 'Lihat Penjualan')

@section('content_header')
<h1 class="text-dark m-0">Daftar Penjualan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allCheckouts as $checkout)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $checkout->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->created_at)->isoFormat('D MMMM YYYY') }}
                            <td>{{ "Rp. " . number_format($checkout->total) }}</td>
                            @if($checkout->payment)
                            <td><a href="{{ route('checkoutDetail', ['id' => $checkout->id]) }}" class="btn btn-info">Lihat Bukti Pembayaran</a></td>
                            <td class="text-center"><a href="{{ route('checkoutInvoice', ['id' => $checkout->id]) }}"
                                    class="btn btn-primary" target="_blank">Cetak Invoice</a></td>
                            @else
                            <td><a href="" class="btn btn-info disabled" disabled>Lihat Bukti Pembayaran</a></td>
                            <td class="text-center"><a href="{{ route('checkoutInvoice', ['id' => $checkout->id]) }}"
                                    class="btn btn-primary disabled" disabled>Cetak Invoice</a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right mt-3">
                    {{ $allCheckouts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
