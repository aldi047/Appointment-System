@extends('adminlte::page')

@section('title', 'Obat')

@section('content_header')
    <h1>Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <div class="card-title">
                        <div class="input-group" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control border-secondary float-right"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary btn-block">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-tools">
                        <a href="{{ route('drugs.create') }}">
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
                                <th>Kemasan</th>
                                <th>Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($drugs as $drug)
                                <tr>
                                    <td class="align-middle">
                                        {{ ((request()->page <= 0 ? 1 : request()->page) - 1) * $page_items + $loop->iteration }}
                                    </td>
                                    <td class="align-middle">{{ $drug->nama_obat }}</td>
                                    <td class="align-middle">{{ $drug->kemasan }}</td>
                                    <td class="align-middle">{{ $drug->harga }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('drugs.edit', $drug->id) }}">Edit</a>
                                            <form class="btn btn-danger btn-sm"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('drugs.destroy', $drug->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-transparent border-0 text-white w-100"
                                                    type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td class="alert alert-danger text-center" colspan="5">
                                    Data obat kosong.
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-right">
                {{ $drugs->links() }}
            </div>
        </div>
    </div>
@stop
