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
                                <th>No Antrian</th>
                                <th>Nama Pasien</th>
                                <th>Keluhan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($examination_datas as $examination)
                                <tr>
                                    <td class="align-middle">{{ $examination->no_antrian }}</td>
                                    <td class="align-middle">{{ $examination->nama }}</td>
                                    <td class="align-middle">{{ $examination->keluhan }}</td>
                                    <td class="text-center">
                                        @if ($examination->status_periksa == 0)
                                        <a class="btn btn-primary btn-sm" href="">
                                            <i class="nav-icon fas fa-stethoscope"> Periksa</i>
                                        </a>
                                        @else
                                        <a class="btn btn-warning btn-sm" href="">
                                            <i class="nav-icon fas fa-stethoscope text-grey"> Edit</i>
                                        </a>
                                        @endif
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
                    {{ $examination_datas->links() }}
                </div>

            </div>

        </div>
    </div>

@stop
