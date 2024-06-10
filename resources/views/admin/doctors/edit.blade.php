@extends('adminlte::page')

@section('title', 'Edit Dokter')

@section('content_header')
    <h1>Edit Dokter</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Dokter</label>
                                <input type="text" class="form-control"
                                    name="nama" value="{{ old('nama', $doctor->nama) }}" placeholder="Nama Dokter">

                                <!-- error message untuk nama -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control"
                                    name="alamat" value="{{ old('alamat', $doctor->alamat) }}" placeholder="Alamat">

                                <!-- error message untuk alamat -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">No.Hp</label>
                                <input type="text" class="form-control"
                                    name="no_hp" value="{{ old('no_hp', $doctor->no_hp) }}" placeholder="Nomor HP">

                                <!-- error message untuk no_hp -->
                                @error('no_hp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Poli</label>
                                <select name="polyclinic_id" id="id_poly" class="form-control">
                                    <option value="">--- Pilih Poli ---</option>
                                </select>
                                <!-- error message untuk polyclinic_id -->
                                @error('polyclinic_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary float-right mx-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        var $dropdown = $('#id_poly');
        var id = @json($doctor->polyclinic_id);
        $.ajax({
            type:"GET",
            url:location.origin + "/list_polyclinic",
            success: function (data) {
                if(Object.keys(data).length = 0){
                    $dropdown.find('option').remove()
                    $dropdown.append('<option value=""'+'>' + 'Poli Kosong' + '</option>');
                } else{
                    for (const [key, value] of Object.entries(data)){
                        $dropdown.append('<option value =' + value.id + '>' + value.nama_poli + '</option>')
                    }
                    // Select data
                    $dropdown.val(id).selected;
                }
                // Buat Belajar
                // var listPoly = [];
                // for (const [key, value] of Object.entries(data)){
                //     console.log(key,value.nama_poli)
                // }

                // data.forEach(addPoly);
                // function addPoly(item, index){
                //     listPoly.push(
                //         [item.id, item.nama_poli]
                //     );
                // }
            }
        });
    });
</script>
@stop
