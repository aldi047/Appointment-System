@extends('adminlte::page')

@section('title', 'Edit Periksa Pasien')

@section('content_header')
    <h1>Edit Periksa Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('examinations.update', $examination_data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <input type="text" class="form-control" value="{{ $examination_data->nama }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Periksa</label>
                                <input type="datetime-local" class="form-control" name="tgl_periksa"
                                    value="{{ old('tgl_periksa', $examination_data->tgl_periksa) }}">

                                <!-- error message untuk tgl_periksa -->
                                @error('tgl_periksa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Catatan</label>
                                <input type="text" class="form-control" name="catatan"
                                    value="{{ old('catatan', $examination_data->catatan) }}" placeholder="Catatan">

                                <!-- error message untuk catatan -->
                                @error('catatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Poli</label>
                                <select class="js-example-basic-multiple form-control" name="drug_id[]" multiple="multiple"
                                    id="drug_select">
                                </select>
                                <!-- error message untuk drug_id -->
                                @error('drug_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-warning float-right mx-4">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href={{ asset('assets/css/select2.min.css') }}>
@stop

@section('js')
    <script src={{ asset('assets/js/select2.min.js') }}></script>
    <script>
        $(document).ready(function() {
            $('#drug_select').select2({
                placeholder: 'Pilih obat',
                minimumInputLength: 2,
                ajax: {
                    url: location.origin + '/getDrugs',
                    dataType: 'json',
                    processResults: data => {
                        return {
                            results: data.map((drug) => {
                                return {
                                    text: drug.text,
                                    id: drug.id
                                };
                            })
                        }
                    }
                }
            });

            // Fetch the preselected item, and add to the control
            var drugSelect = $('#drug_select');
            var drugs_id = {{ $examination_data->id }};
            $.ajax({
                type: 'GET',
                url: location.origin + '/getDrugs/s/' + drugs_id,
            }).then(function(data) {
                data.map((drug) => {
                    // create the option and append to Select2
                    var option = new Option(drug.text, drug.id, true, true);
                    drugSelect.append(option).trigger('change');
                })

                // manually trigger the `select2:select` event
                drugSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            });
            // Using pagging
            // $('.js-example-basic-multiple').select2({
            //     minimumInputLength: 2,
            //     placeholder: '--- Pilih 0bat ---',
            //     ajax: {
            //         url: location.origin + '/getDrugs',
            //         dataType: "json",
            //         data: (params) => {
            //             let query = {
            //                 search: params.term,
            //                 page: params.page || 1,
            //             };
            //             return query;
            //         },
            //         processResults: data => {
            //             return {
            //                 results: data.data.map((drug) => {
            //                     return {
            //                         text: drug.text,
            //                         id: drug.id
            //                     };
            //                 }),
            //                 pagination: {
            //                     more: data.current_page < data.last_page,
            //                 },
            //             };
            //         },
            //     },
            // });
        });
    </script>
@stop
