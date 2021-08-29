@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
<h1 class="m-0 text-dark">Edit User</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('userUpdate', ['id' => $userData->id]) }}" method="POST">
                    @csrf
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                value="{{ $userData->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" name="email" id="exampleFormControlInput1"
                                value="{{ $userData->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleFormControlInput1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Telepon</label>
                            <input type="number" placeholder="08..." class="form-control" name="phone_number"
                                id="exampleFormControlInput1" value="{{ $userData->profile->phone_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input type="text" class="form-control" name="address" id="exampleFormControlInput1"
                                value="{{ $userData->profile->address }}" required>
                        </div>
                        <div class="text-right"><input type="submit" value="Simpan" class="btn btn-primary"></div>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
