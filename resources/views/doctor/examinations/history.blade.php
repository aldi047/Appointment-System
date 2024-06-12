@extends('adminlte::page')

@section('title', 'Pemeriksaan')

@section('content_header')
    <h1>Periksa Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
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
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $history->nama }}</td>
                                    <td class="align-middle">{{ $history->alamat }}</td>
                                    <td class="align-middle">{{ $history->no_ktp }}</td>
                                    <td class="align-middle">{{ $history->no_hp }}</td>
                                    <td class="align-middle" id="no_rm">{{ $history->no_rm }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#historyModal">
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
                </div>
            </div>
            <div class="float-right">
                {{ $histories->links() }}
            </div>
            <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="historyModalLabel">Riwayat Pasien</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover" id="tb_history">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('tr').click(function() {
                var noRM = $(this).find('#no_rm').text();
                let table = document.getElementById("tb_history");

                // delete element
                table.innerHTML = '';

                // Create header element
                let header = document.createElement("tr")
                header.innerHTML = `<tr>
                                        <th>No</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Catatan</th>
                                        <th>Obat</th>
                                    </tr>`;
                table.appendChild(header)

                $.ajax({
                    type: "GET",
                    url: location.origin + "/patient-history/" + noRM,
                    success: function(data) {
                        for (const [key, value] of Object.entries(data)) {



                            // Create row element
                            let row = document.createElement("tr")

                            let nama_dokter = @json($nama_dokter).replace('"','');
                            let obat = @json($drugs[$history->id]).replace('"','');

                            row.innerHTML = `<tr><td class="align-middle">${parseInt(key) + 1}</td>
                            <td class="align-middle">${value.tgl_periksa.substring(0,10)}</td>
                            <td class="align-middle">${value.nama}</td>
                            <td class="align-middle">${nama_dokter}</td>
                            <td class="align-middle">${value.keluhan}</td>
                            <td class="align-middle">${value.catatan}</td>
                            <td class="align-middle">${obat}</td></tr>`;

                            // Append row to table body
                            table.appendChild(row)
                        }
                    }
                });
            });
        });
    </script>
@stop
