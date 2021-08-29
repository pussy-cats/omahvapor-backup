@extends('adminlte::page')

@section('title', 'Lihat Testimoni')

@section('content_header')
<h1 class="text-dark m-0">Daftar Testimoni</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @include('layouts.flash')
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Isi Testimoni</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTestimonials as $testimonial)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $testimonial->user->name }}</td>
                            <td>{{ $testimonial->text }}</td>
                            <td><a href="{{ route('testimonialDelete', ['id' => $testimonial->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
