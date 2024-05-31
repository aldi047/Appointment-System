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
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No KTP</th>
                                <th>No Telepon</th>
                                <th>No RM</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($histories as $history)
                                <tr>
                                    <td class="align-middle">{{ $history->id }}</td>
                                    <td class="align-middle">{{ $history->nama }}</td>
                                    <td class="align-middle">{{ $history->alamat }}</td>
                                    <td class="align-middle">{{ $history->no_ktp }}</td>
                                    <td class="align-middle">{{ $history->no_hp }}</td>
                                    <td class="align-middle">{{ $history->no_rm }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#historyModal">
                                            <i class="nav-icon fa fa-eye"> Detail Riwayat Periksa</i>
                                        </button>
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
                    {{ $histories->links() }}
                </div>
            </div>

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
                            <div class="card-body table-responsive p-0">
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
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td class="align-middle">{{ $history->id }}</td>
                                                <td class="align-middle">{{ $history->tgl_periksa }}</td>
                                                <td class="align-middle">{{ $history->nama }}</td>
                                                <td class="align-middle">{{ $nama_dokter}}</td>
                                                <td class="align-middle">{{ $history->keluhan }}</td>
                                                <td class="align-middle">{{ $history->catatan }}</td>
                                                <td class="align-middle">{{ $drugs[$history->id] }}</td>
                                            </tr>
                                        @endforeach
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
