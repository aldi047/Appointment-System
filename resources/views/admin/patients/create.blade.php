@extends('adminlte::page')

@section('title', 'Tambah Pasien')

@section('content_header')
    <h1>Tambah Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <input type="text" class="form-control"
                                    name="nama" value="{{ old('nama') }}" placeholder="Nama Pasien">

                                <!-- error message untuk nama -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control"
                                    name="alamat" value="{{ old('alamat') }}" placeholder="Alamat">

                                <!-- error message untuk alamat -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">No. KTP</label>
                                <input type="text" class="form-control"
                                    name="no_ktp" value="{{ old('no_ktp') }}" placeholder="Nomor KTP">

                                <!-- error message untuk no_ktp -->
                                @error('no_ktp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">No.Hp</label>
                                <input type="text" class="form-control"
                                    name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor HP">

                                <!-- error message untuk no_hp -->
                                @error('no_hp')
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
