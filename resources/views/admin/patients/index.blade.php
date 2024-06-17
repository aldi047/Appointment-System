@extends('adminlte::page')

@section('title', 'Pasien')

@section('content_header')
    <h1>Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('patients.create') }}">
                            <button type="button" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nomor KTP</th>
                                <th>Nomor HP</th>
                                <th>Nomor RM</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $patient)
                                <tr>
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $patient->nama }}</td>
                                    <td class="align-middle">{{ $patient->alamat }}</td>
                                    <td class="align-middle">{{ $patient->no_ktp }}</td>
                                    <td class="align-middle">{{ $patient->no_hp }}</td>
                                    <td class="align-middle">{{ $patient->no_rm }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('patients.edit', $patient->id) }}">Edit</a>
                                            <form class="btn btn-danger btn-sm"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-transparent border-0 text-white w-100"
                                                    type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                @section('content')
                                    <div class="alert alert-danger">
                                        Data pasien kosong.
                                    </div>
                                @stop
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-right">
                {{ $patients->links() }}
            </div>
        </div>
    </div>

@stop


