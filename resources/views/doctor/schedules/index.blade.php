@extends('adminlte::page')

@section('title', 'Jadwal Periksa')

@section('content_header')
    <h1>Jadwal Periksa</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('schedules.create') }}">
                            <button type="button" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $name }}</td>
                                    <td class="align-middle">{{ $schedule->hari }}</td>
                                    <td class="align-middle">{{ $schedule->jam_mulai }}</td>
                                    <td class="align-middle">{{ $schedule->jam_selesai }}</td>
                                    <td class="align-middle">
                                        @if($schedule->status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            @if ($today != $schedule->hari)
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('schedules.edit', $schedule->id) }}">Edit</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td class="alert alert-danger text-center" colspan="8">
                                    Jadwal kosong.
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-right">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@stop
