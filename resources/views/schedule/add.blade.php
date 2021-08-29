@extends('adminlte::page')

@section('title', 'Bengkel')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Jadwal</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('scheduleCreate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Pelanggan</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="user_id">
                            @foreach($allUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Jadwal</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="date"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="description"></textarea>
                    </div>
                    <div class="float-right">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
