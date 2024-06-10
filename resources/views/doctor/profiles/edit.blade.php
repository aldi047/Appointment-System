@extends('adminlte::page')

@section('title', 'Edit Profil')

@section('content')
    <div class="card mt-3">
        <div class="card-header bg-success">
            <div class="card-title">
                <h5 class="mb-0">Edit Profil Dokter</h5>
            </div>
        </div>
        <div class="card-body py-0 px-3">
            <form action="{{ route('profiles.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body pb-0 px-0">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Dokter</label>
                        <input type="text" class="form-control"
                            name="nama" value="{{ old('nama', $doctor->nama) }}">

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
                            name="alamat" value="{{ old('alamat', $doctor->alamat) }}">

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
                            name="no_hp" value="{{ old('no_hp', $doctor->no_hp) }}">

                        <!-- error message untuk no_hp -->
                        @error('no_hp')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success btn-block font-weight-bolder mb-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@stop
