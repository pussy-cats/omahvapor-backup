@extends('layouts.app')

@section('title', 'Riwayat Belanja')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h5 class="display-5 text-bold my-4">Riwayat Belanja</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('layouts.flash')
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Belanja</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Quantity Produk</th>
                        <th scope="col">Total Belanja</th>
                        <th scope="col">Biaya Ongkir</th>
                        <th scope="col">Total Harga</th>
                        <th class="text-center" scope="col" colspan="3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allInvoices as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->created_at)->isoFormat('D MMMM YYYY') }}
                        <td>{{ $invoice->carts_count }} Item</td>
                        <td>{{ $invoice->carts->sum('quantity') }} Item</td>
                        <td>Rp. {{ number_format($invoice->total) }}</td>
                        <td>Rp. {{ number_format($invoice->deliveryfee) }}</td>
                        <td>Rp. {{ number_format($invoice->total + $invoice->deliveryfee) }}</td>
                        <td class="text-center"><a href="" class="btn btn-info">Detail</a></td>
                        @if($invoice->payment)
                        <td><a href="" class="btn btn-primary disabled" disabled>Sudah Dibayar</a></td>
                        <td class="text-center"><a href="{{ route('checkoutInvoice', ['id' => $invoice->id]) }}" class="btn btn-success">Cetak Nota</a></td>
                        @else
                        <td><a href="{{ route('addPayment', ['id' => $invoice->id]) }}" class="btn btn-primary">Bayar</a></td>
                        <td class="text-center"><a href="" class="btn btn-success disabled" disabled>Cetak Nota</a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
