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
                        <button type="button" class="btn btn-outline-primary btn-block">
                            <a href="{{ route('drugs.create') }}">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </button>
                    </div>
                </div>

                <div class="card-body table-responsive p-0" style="height: 65vh;">
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
                                    <td class="align-middle">{{ $drug->id }}</td>
                                    <td class="align-middle">{{ $drug->nama_obat }}</td>
                                    <td class="align-middle">{{ $drug->kemasan }}</td>
                                    <td class="align-middle">{{ $drug->harga }}</td>
                                    <td>
                                        <div class="btn-group btn-block btn-sm">
                                            <a class="btn btn-primary btn-sm" href="{{route('drugs.edit', $drug->id)}}">Edit</a>
                                            {{-- <button type="button" class="btn btn-outline-danger btn-sm">Hapus</button> --}}
                                            <form class="btn btn-danger btn-sm" onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('drugs.destroy', $drug->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-transparent border-0 text-white" type="submit" >Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data obat kosong.
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@stop
