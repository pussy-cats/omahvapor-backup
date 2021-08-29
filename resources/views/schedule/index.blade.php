@extends('adminlte::page')

@section('title', 'Bengkel')

@section('content_header')
<h1 class="m-0 text-dark">Data Jadwal Bengkel (Tabel)</h1>
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
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Hari Jadwal</th>
                            <th scope="col">Deskripsi Jadwal</th>
                            <th scope="col">Tanggal Pembuatan Jadwal</th>
                            <th scope="col" colspan="3" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allSchedules as $schedule)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $schedule->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->isoFormat('D MMMM YYYY')  }}</td>
                            <td>{{ $schedule->description }}</td>
                            <td>{{ $schedule->created_at }}</td>
                            <td class="text-center"><a href="{{ route('scheduleDetail', ['id' => $schedule->id]) }}"
                                    class="btn btn-info">Detail</a></td>
                            <td class="text-center"><a href="{{ route('scheduleEdit', ['id' => $schedule->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a href="{{ route('scheduleDelete', ['id' => $schedule->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4">{{ $allSchedules->links() }}</div>
            </div>
        </div>
    </div>
</div>
@stop
