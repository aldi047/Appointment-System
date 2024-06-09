@extends('adminlte::page')

@section('title', 'Poliklinik')

@section('content_header')
    <h1>Poliklinik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('polyclinics.create') }}">
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
                                <th>Nama Poli</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polyclinics as $polyclinic)
                                <tr>
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $polyclinic->nama_poli }}</td>
                                    <td class="align-middle">{{ $polyclinic->keterangan }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('polyclinics.edit', $polyclinic->id) }}">Edit</a>
                                            <form class="btn btn-danger btn-sm"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('polyclinics.destroy', $polyclinic->id) }}" method="POST">
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
                                    Data poliklinik kosong.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-right">
                {{ $polyclinics->links() }}
            </div>
        </div>
    </div>

@stop


