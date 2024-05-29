@extends('adminlte::page')

@section('title', 'Tambah Obat')

@section('content_header')
    <h1>Tambah Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('drugs.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Obat</label>
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
                        </div>
                        <button type="submit" class="btn btn-md btn-primary float-right mx-4">Tambah</button>
                        <button type="reset" class="btn btn-md btn-warning float-right">Reset</button>
                    </form>
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
