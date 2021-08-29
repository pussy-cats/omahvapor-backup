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
                            <th scope="col">Tanggal Jadwal</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Jumlah Kembali</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allCheckouts as $checkout)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @if($checkout->schedule)
                            <td>{{ $checkout->schedule->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->schedule->start_time)->isoFormat('D MMMM YYYY') }}
                            </td>
                            @else
                            <td>{{ $checkout->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->created_at)->isoFormat('D MMMM YYYY') }}
                                @endif
                            <td>{{ "Rp. " . number_format($checkout->total) }}</td>
                            <td>{{ "Rp. " . number_format($checkout->pay)}}</td>
                            <td>{{ "Rp. " . number_format($checkout->change)}}</td>
                            <td class="text-center"><a href="{{ route('checkoutInvoice', ['id' => $checkout->id]) }}"
                                    class="btn btn-primary">Cetak Invoice</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
