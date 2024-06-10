@extends('adminlte::page')

@section('title', 'Tambah Jadwal')

@section('content_header')
    <h1>Tambah Jadwal</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Hari</label>
                                <select class="form-control @error('hari') is-invalid @enderror" name="hari"
                                id="select_hari">
                                    <option value="-----" selected>Pilih hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jum'at</option>
                                </select>

                                <!-- error message untuk hari -->
                                @error('hari')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jam Mulai</label>
                                <input type="time"class="form-control @error('jam_mulai') is-invalid @enderror"
                                    name="jam_mulai" value="{{ old('jam_mulai', session('jam_mulai')) }}">

                                <!-- error message untuk jam_mulai -->
                                @error('jam_mulai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jam Selesai</label>
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    name="jam_selesai" value="{{ old('jam_selesai', session('jam_selesai')) }}">

                                <!-- error message untuk jam_selesai -->
                                @error('jam_selesai')
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
