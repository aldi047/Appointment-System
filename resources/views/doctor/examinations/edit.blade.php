@extends('adminlte::page')

@section('title', 'Periksa Pasien')

@section('content_header')
    <h1>Periksa Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Dokter</label>
                                <input type="text" class="form-control"
                                    name="nama" value="{{ old('nama') }}" placeholder="Nama Dokter">

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
                            <div class="form-group">
                                <label class="font-weight-bold">Poli</label>
                                <select name="polyclinic_id" class="form-control">
                                    <option value="">--- Pilih Poli ---</option>
                                    @forelse ($polyclinics as $polyclinic)
                                        <option {{ old('polyclinic_id') == $polyclinic->id ? "selected" : "" }} value={{$polyclinic->id}}>{{$polyclinic->nama_poli}}</option>
                                    @empty
                                    <option value="">Poliklinik Kosong</option>
                                    @endforelse
                                </select>
                                <!-- error message untuk polyclinic_id -->
                                @error('polyclinic_id')
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
