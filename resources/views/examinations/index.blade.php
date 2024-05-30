@extends('adminlte::page')

@section('title', 'Pemeriksaan')

@section('content_header')
    <h1>Periksa Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0" style="height: 65vh;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No Urut</th>
                                <th>Nama Pasien</th>
                                <th>Keluhan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($examinations as $examination)
                                <tr>
                                    <td class="align-middle">{{ $examination->id }}</td>
                                    <td class="align-middle">{{ $examination->nama_pasien }}</td>
                                    <td class="align-middle">{{ $examination->keluhan }}</td>
                                    <td>
                                        {{-- <a class="btn btn-block btn-primary btn-sm"
                                            href="{{ route('examination.edit', $examination->id) }}">Edit</a> --}}
                                    </td>
                                </tr>
                            @empty
                                @section('content')
                                    <div class="alert alert-danger">
                                        Tidak ada jadwal pemeriksaan.
                                    </div>
                                @stop
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

@stop
