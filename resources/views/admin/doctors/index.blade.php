@extends('adminlte::page')

@section('title', 'Dokter')

@section('content_header')
    <h1>Dokter</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('doctors.create') }}">
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
                                <th>No.Hp</th>
                                <th>Poli</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $doctor->nama }}</td>
                                    <td class="align-middle">{{ $doctor->alamat }}</td>
                                    <td class="align-middle">{{ $doctor->no_hp }}</td>
                                    <td class="align-middle">{{ $doctor->nama_poli }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('doctors.edit', $doctor->id) }}">Edit</a>
                                            <form class="btn btn-danger btn-sm"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
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
                                        Data dokter kosong.
                                    </div>
                                @stop
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-right">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
@stop
