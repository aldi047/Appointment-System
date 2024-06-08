@extends('adminlte::page')

@section('title', 'Daftar Poli')

@section('content_header')
    <h1>Daftar Poli</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 w-100">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h5 class="mb-0">Daftar Poli</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('drugs.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Rekam Medis</label>
                                <input type="text" class="form-control @error('nama_obat') is-invalid @enderror"
                                    name="nama_obat" value="{{ old('nama_obat') }}" placeholder="Nama Obat">

                                <!-- error message untuk nama_obat -->
                                @error('nama_obat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kemasan</label>
                                <input type="text" class="form-control @error('kemasan') is-invalid @enderror"
                                    name="kemasan" value="{{ old('kemasan') }}" placeholder="Nama Obat">

                                <!-- error message untuk kemasan -->
                                @error('kemasan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" value="{{ old('harga') }}" placeholder="Nama Obat">

                                <!-- error message untuk harga -->
                                @error('harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary float-right">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h5 class="mb-0">Riwayat Daftar Poli</h5>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Antrian</th>
                                    <th>Aksi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
