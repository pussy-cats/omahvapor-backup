@extends('adminlte::page')

@section('title', 'Bengkel')

@section('content_header')
<h1 class="m-0 text-dark">Data Jadwal Bengkel (Kalender)</h1>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! $allSchedules->calendar() !!}
                {!! $allSchedules->script() !!}
            </div>
        </div>
    </div>
</div>
@stop
