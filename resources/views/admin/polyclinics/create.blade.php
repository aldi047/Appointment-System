@extends('adminlte::page')

@section('title', 'Tambah Poliklinik')

@section('content_header')
    <h1>Tambah Poliklinik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('polyclinics.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Poliklinik</label>
                                <input type="text" class="form-control"
                                    name="nama_poli" value="{{ old('nama_poli') }}" placeholder="Nama Poliklinik">

                                <!-- error message untuk nama_poli -->
                                @error('nama_poli')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <input type="text" class="form-control"
                                    name="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan">

                                <!-- error message untuk keterangan -->
                                @error('keterangan')
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
