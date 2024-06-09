@extends('adminlte::page')

@section('title', 'Edit Pasien')

@section('content_header')
    <h1>Edit Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <input type="text" class="form-control"
                                    name="nama" value="{{ old('nama', $patient->nama) }}" placeholder="Nama Pasien">

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
                                    name="alamat" value="{{ old('alamat', $patient->alamat) }}" placeholder="Alamat">

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
                                    name="no_ktp" value="{{ old('no_ktp', $patient->no_ktp) }}" placeholder="Nomor KTP">

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
                                    name="no_hp" value="{{ old('no_hp', $patient->no_hp) }}" placeholder="Nomor HP">

                                <!-- error message untuk no_hp -->
                                @error('no_hp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">No.Rekam Medis</label>
                                <input type="text" class="form-control"
                                    name="no_rm" value="{{ old('no_rm', $patient->no_rm) }}" placeholder="Nomor Rekam Medis">

                                <!-- error message untuk no_rm -->
                                @error('no_rm')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary float-right mx-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
