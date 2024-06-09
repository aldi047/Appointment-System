@extends('adminlte::page')

@section('title', 'Detail Riwayat')

@section('content_header')
    <h1>Detail Riwayat</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <div class="card-title">
                <h5 class="mb-0 text-center">Detail Riwayat</h5>
            </div>
        </div>
        <div class="card-body text-center">
            <h5>Nama Poli</h5>
            <h6>{{ $history->nama_poli }}</h6>
            <hr>
            <h5>Nama Dokter</h5>
            <h6>{{ $history->nama }}</h6>
            <hr>
            <h5>Hari</h5>
            <h6>{{ $history->hari }}</h6>
            <hr>
            <h5>Jam Mulai</h5>
            <h6>{{ substr($history->jam_mulai, 0, 5) }}</h6>
            <hr>
            <h5>Jam Selesai</h5>
            <h6>{{ substr($history->jam_selesai, 0, 5) }}</h6>
            <hr>
            <h5>Nomor Antrian</h5>
            <h1><span class="badge badge-success">{{$history->no_antrian}}</span></h1>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> --}}
@stop
