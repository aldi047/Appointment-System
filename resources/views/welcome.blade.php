@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner text-center">
                <h3>{{$registration}} Reservasi</h3>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <p class="small-box-footer">Total reservasi keseluruhan</p>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
@stop
