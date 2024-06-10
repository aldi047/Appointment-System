@extends('adminlte::page')

@section('title', 'Profil Dokter')

@section('content')
    <div class="card mt-3">
        <div class="card-header bg-primary">
            <div class="card-title">
                <h5 class="mb-0">Profil Dokter</h5>
            </div>
        </div>
        <div class="card-body pb-0 px-3">
            <div class="form-group">
                <label class="font-weight-bold">Nama Dokter</label>
                <input type="text" class="form-control"
                    name="nama" value="{{ $doctor->nama }}" disabled>

                <!-- error message untuk nama -->
                @error('nama')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Alamat Dokter</label>
                <input type="text" class="form-control"
                    name="alamat" value="{{ $doctor->alamat }}" disabled>

                <!-- error message untuk alamat -->
                @error('alamat')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nomor HP Dokter</label>
                <input type="text" class="form-control"
                    name="no_hp" value="{{ $doctor->no_hp }}" disabled>

                <!-- error message untuk no_hp -->
                @error('no_hp')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <a href="{{ route('profiles.edit', $doctor->id) }}" class="mb-3 mx-3">
            <button type="button" class="btn btn-outline-primary btn-block font-weight-bolder">Edit Profil</button>
        </a>
    </div>
@stop
