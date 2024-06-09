@extends('adminlte::page')

@section('title', 'Daftar Poli')

{{-- @section('content_header')
    <h1>Daftar Poli</h1>
@stop --}}

@section('content')
    <div class="row mt-2">
        <div class="col-sm-12 col-md-6 col-lg-4 col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h5 class="mb-0">Daftar Poli</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('reg-poly') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Rekam Medis</label>
                                <input type="text" class="form-control" name="nama_obat"
                                    value="{{ old('nama_obat', $no_rm) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Poli</label>
                                <select name="polyclinic_id" id="polyclinic_select" class="form-control">
                                    <option value="">--- Pilih Poli ---</option>
                                    @forelse ($polyclinics as $polyclinic)
                                        <option value={{ $polyclinic->id }}>{{ $polyclinic->nama_poli }}</option>
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
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Jadwal</label>
                                <select name="examination_schedule_id" id="examination_schedule" class="form-control">
                                    <option value="">--- Pilih Jadwal ---</option></select>
                                <!-- error message untuk examination_schedule_id -->
                                @error('examination_schedule_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Keluhan</label>
                                <textarea class="form-control" name="keluhan" rows="2">{{session('keluhan') == null ? "":session('keluhan')}}</textarea>

                                <!-- error message untuk keluhan -->
                                @error('keluhan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary float-right">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h5 class="mb-0">Riwayat Daftar Poli</h5>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="card-body table-responsive p-0" style="height: 65vh;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Antrian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr>
                                        <td class="align-middle text-center">
                                            @if($loop->iteration == 1)
                                                <span class="badge badge-primary">Baru</span>
                                            @else
                                                {{$loop->iteration}}
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $history->nama_poli }}</td>
                                        <td class="align-middle">{{ $history->nama }}</td>
                                        <td class="align-middle">{{ $history->hari }}</td>
                                        <td class="align-middle">{{ $history->jam_mulai }}</td>
                                        <td class="align-middle">{{ $history->jam_selesai }}</td>
                                        <td class="align-middle">{{ $history->no_antrian }}</td>
                                        <td>
                                            <div class="btn-group btn-block btn-sm">
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('detail',$history->id) }}">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Riwayat kosong.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            var $dropdown = $('#examination_schedule');

            $("#polyclinic_select").on("change", function() {
                var id_jadwal = $("#polyclinic_select option:selected").val();
                showDropdownSchedule(id_jadwal);

            });

            function showDropdownSchedule(id) {
                $.ajax({
                    type: "GET",
                    url: location.origin + '/getSchedule/' + id,
                    success: function(data) {
                        if (Object.keys(data).length == 0) {
                            $dropdown.find('option').remove()
                            $dropdown.append('<option value="">--- Jadwal Kosong ---</option>');
                        } else {
                            $dropdown.find('option').remove()
                            for (const [key, value] of Object.entries(data)) {
                                $dropdown.append('<option value =' + value.id + '>' + value.desc +
                                    '</option>')
                            }
                        }
                    }
                });
            }
        });

    </script>
@stop
