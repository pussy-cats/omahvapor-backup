@extends('adminlte::page')

@section('title', 'Data Admin')

@section('content_header')
<div class="row">
    <div class="col-sm-8">
        <h1 class="m-0 text-dark">Data Admin</h1>
    </div>
    <div class="col-sm-4">
        <a href="{{ route('adminAdd') }}" class="btn btn-primary float-right">Tambah Data Admin</a>
    </div>
</div>
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
                            <th scope="col">Nama Admin</th>
                            <th scope="col">Email Admin</th>
                            <th scope="col">Nomor HP Admin</th>
                            <th scope="col">Alamat Admin</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allAdmins as $admin)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            @if($admin->profile)
                            <td>{{ @$admin->profile->phone_number }}</td>
                            <td>{{ @$admin->profile->address }}</td>
                            @else
                            <td>Belum Diisi</td>
                            <td>Belum Diisi</td>
                            @endif
                            <td class="text-center"><a href="{{ route('adminEdit', ['id' => $admin->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a href="{{ route('adminDelete', ['id' => $admin->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4">{{ $allAdmins->links() }}</div>
            </div>
        </div>
    </div>
</div>
@stop
