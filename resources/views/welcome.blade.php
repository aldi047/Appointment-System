@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Selamat datang {{ $name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="small-box bg-success">
                <div class="inner text-center">
                    <h3>{{ $registrations }} Reservasi</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <p class="small-box-footer">Total reservasi keseluruhan</p>
            </div>
        </div>
        <div class="col">
            <div class="small-box bg-primary">
                <div class="inner text-center">
                    <h3>{{ $patients }} Pasien</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <p class="small-box-footer">Total pasien keseluruhan</p>
            </div>
        </div>
        <div class="col">
            <div class="small-box bg-info">
                <div class="inner text-center">
                    <h3>{{ $doctors }} Dokter</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <p class="small-box-footer">Total dokter keseluruhan</p>
            </div>
        </div>
    </div>
@stop
