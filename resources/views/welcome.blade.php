@extends('adminlte::master')

@section('title', 'Appointment System')

@section('body')
    <div class="text-center bg-primary">
        <h5 class="text-left ml-5 pt-2">Poliklinik</h5>
        <div class="p-5">
            <h1 class="font-weight-bold">Sistem Temu Janji</h1>
            <h1 class="font-weight-bold">Pasien Dokter</h1>
            <h6>Bimbingan Karir 2024 Bidang Web</h6>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row p-4 justify-content-center">
            <div class="col-lg-5 col-md-4 col-sm3 p-3">
                <a href="/register" class="btn btn-primary p-2 mb-2">
                    <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                </a>
                <h3 class="font-weight-bold">Login sebagai pasien</h3>
                <p>Apabila anda adalah seorang pasien, silakan login terlebih dahulu untuk melakukan pendaftaran sebagai
                    pasien</p>
                <a href="/register">Klik link berikut &#10230</a>
            </div>
            <div class="col-lg-5 col-md-4 col-sm3 p-3">
                <a href="/login" class="btn btn-primary p-2 mb-2">
                    <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                </a>
                <h3 class="font-weight-bold">Login sebagai dokter</h3>
                <p>Apabila anda seorang dokter, silakan login terlebih dahulu untuk memulai melayani pasien</p>
                <a href="/login">Klik link berikut &#10230</a>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center my-5">
        <h1>Testimoni Pasien</h1>
        <h5>Para pasien yang setia</h5>
        <div class="row d-flex justify-content-center pt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body m-3">
                        <div class="row">
                            <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                                <i class="fa fa-quote-right fa-6x" style="color: Dodgerblue;" aria-hidden="true"></i>
                            </div>
                            <div class="col-lg-8">
                                <p class="text-black fw-light text-left mb-4">
                                    Pelayanan di web ini sangat cepat dan mudah. Detail histori tercatat lengkap, termasuk
                                    catatan obat. Harga pelayanan terjangkau, dokter ramah, pokoke mantab pol!
                                </p>
                                <p class="fw-bold text-muted text-left mb-0">- Adi, Semarang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body m-3">
                        <div class="row">
                            <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                                <i class="fa fa-quote-right fa-6x" style="color: Dodgerblue;" aria-hidden="true"></i>
                            </div>
                            <div class="col-lg-8">
                                <p class="text-black fw-light text-left mb-4">
                                    Aku tidak pernah merasakan mudahnya berobat sebelum aku mengenal web ini. Web yang mudah digunakan dan dokter yang terampil membuat berobat menjadi lebih menyenangkan!
                                </p>
                                <p class="fw-bold text-muted text-left mb-0">- Ida, Semarang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
