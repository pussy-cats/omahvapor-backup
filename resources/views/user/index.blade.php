@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
<div class="row">
    <div class="col-sm-8">
        <h1 class="m-0 text-dark">Data User</h1>
    </div>
    <div class="col-sm-4">
        <a href="{{ route('userAdd') }}" class="btn btn-primary float-right">Tambah Data Pengguna</a>
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
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Email Pelanggan</th>
                            <th scope="col">Nomor HP Pelanggan</th>
                            <th scope="col">Alamat Pelanggan</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allUsers as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->profile)
                            <td>{{ @$user->profile->phone_number }}</td>
                            <td>{{ @$user->profile->address }}</td>
                            @else
                            <td>Belum Diisi</td>
                            <td>Belum Diisi</td>
                            @endif
                            <td class="text-center"><a href="{{ route('userEdit', ['id' => $user->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a href="{{ route('userDelete', ['id' => $user->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4">{{ $allUsers->links() }}</div>
            </div>
        </div>
    </div>
</div>
@stop
