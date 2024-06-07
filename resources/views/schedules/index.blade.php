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

                <div class="card-body table-responsive p-0" style="height: 65vh;">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $name }}</td>
                                    <td class="align-middle">{{ $schedule->hari }}</td>
                                    <td class="align-middle">{{ $schedule->jam_mulai }}</td>
                                    <td class="align-middle">{{ $schedule->jam_selesai }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            @if ($today != $schedule->hari)
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('schedules.edit', $schedule->id) }}">Edit</a>
                                            @endif
                                            {{-- <button type="button" class="btn btn-outline-danger btn-sm">Hapus</button> --}}
                                            <form class="btn btn-danger btn-sm"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-transparent border-0 text-white w-100"
                                                    type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Jadwal kosong.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
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
@stop
