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
                                <th>Alamat</th>
                                <th>No KTP</th>
                                <th>No Telepon</th>
                                <th>No RM</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse ($histories as $history)
                                <tr>
                                    <td class="align-middle">{{ $history->no_antrian }}</td>
                                    <td class="align-middle">{{ $history->nama }}</td>
                                    <td class="align-middle">{{ $history->keluhan }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" href="">
                                            <i class="nav-icon fas fa-stethoscope"> Periksa</i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                @section('content')
                                    <div class="alert alert-danger">
                                        Tidak ada jadwal pemeriksaan.
                                    </div>
                                @stop
                            @endforelse --}}
                        </tbody>
                    </table>
                    {{-- {{ $histories->links() }} --}}
                </div>

            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#historyModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="historyModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body table-responsive p-0" style="height: 65vh;">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Periksa</th>
                                            <th>Nama Pasien</th>
                                            <th>Nama Dokter</th>
                                            <th>Keluhan</th>
                                            <th>Catatan</th>
                                            <th>Obat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($histories as $history)
                                            <tr>
                                                <td class="align-middle">{{ $history->no_antrian }}</td>
                                                <td class="align-middle">{{ $history->nama }}</td>
                                                <td class="align-middle">{{ $history->keluhan }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-sm" href="">
                                                        <i class="nav-icon fas fa-stethoscope"> Periksa</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            @section('content')
                                                <div class="alert alert-danger">
                                                    Tidak ada jadwal pemeriksaan.
                                                </div>
                                            @stop
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
