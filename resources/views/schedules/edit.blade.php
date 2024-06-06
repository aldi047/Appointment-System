@extends('adminlte::page')

@section('title', 'Edit Jadwal')

@section('content_header')
    <h1>Edit Jadwal</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Hari</label>
                                <select id="select_hari" name="hari"
                                    class="form-control @error('hari') is-invalid @enderror">
                                    <option value="-----">Pilih hari</option>
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
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    name="jam_mulai" value="{{ old('jam_mulai', $schedule->jam_mulai) }}">

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
                                    name="jam_selesai" value="{{ old('jam_selesai', $schedule->jam_selesai) }}">

                                <!-- error message untuk jam_selesai -->
                                @error('jam_selesai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary float-right mx-4">Edit</button>
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
    <script>
        $(document).ready(function() {
            var day = @json($schedule->hari);
            $('#select_hari').val(day).selected;
            // $('#select_hari').val(day).attr('selected', 'selected');
        });
    </script>
    {{-- <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> --}}
@stop
