@extends('adminlte::page')

@section('title', 'OmahVapor')

@section('content_header')
<h1 class="m-0 text-dark">Edit Jadwal</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('scheduleUpdate', ['id' => $scheduleData->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Pelanggan</label>
                        <input type="text" class="form-control" value="{{ $scheduleData->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Jadwal</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="date"
                            value="{{ \Carbon\Carbon::parse($scheduleData->start_time)->format('Y-m-d') }}"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="description">{{ $scheduleData->description }}</textarea>
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
