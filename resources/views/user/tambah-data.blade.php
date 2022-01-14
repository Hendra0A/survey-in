@extends('user.main')
@section('content')
    <div class="content">
        <div class="container">

            <div class="content ps-3 pe-3">
                <h1 class="col-12 text-center fs-3 mt-2">Tambah Data Survei</h1>
                <p class="col-12 text-center" style="font-size: .9em; color: #A5A5A5;">Silahkan tambah data survei dengan
                    lengkap dan benar di bawah ini</p>

                <form method="POST" action="tambah-data" enctype="multipart/form-data" class="form-tambah"
                    autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="kecamatan" class="form-label d-block fw-bold m-0">Kecamatan</label>
                        <select id="kecamatan"
                            class="form-select form-select-sm m-auto shadow-none border-primary mt-1 @error('kecamatan_id') is-invalid @enderror"
                            style="width: 95%;" aria-label=".form-select-sm example" name="kecamatan_id">
                            <option value="" hidden>Pilih Kecamatan</option>
                            @foreach ($data as $kecamatan)
                                <option {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}
                                    value="{{ $kecamatan->id }}"
                                    {{ $kecamatan->id == auth()->user()->kabupaten_id ? 'selected' : '' }}>
                                    {{ $kecamatan->nama }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Nama gang & lokasi & koordinat -->
                    <div class="row row-cols-3">
                        <div class="col-12 col-sm-6 mb-3">
                            <label for="nama_gang" class="form-label fw-bold">Nama Gang dan Perumahan</label>
                            <input type="text" class="form-control border-primary @error('nama_gang') is-invalid @enderror"
                                style="border-radius: .5em;" id="nama_gang" name="nama_gang"
                                value="{{ old('nama_gang') }}">
                            @error('nama_gang')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                            <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                            <input type="text" class="form-control border-primary @error('lokasi') is-invalid @enderror"
                                style="border-radius: .5em;" id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="input-koordinat" class="form-label fw-bold d-block m-0 mb-2">Koordinat</label>
                        <div class="col-12 d-flex">
                            <button type="button" id="koordinat"
                                class="lokasi btn btn-primary d-flex align-items-center me-2 border-0"
                                style="border-radius: .5em; background: #3F4FC8;"><i
                                    class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                            <input type="text" class="form-control border-primary @error('no_gps') is-invalid @enderror"
                                style="border-radius: .5em;" id="input-koordinat" name="no_gps"
                                value="{{ old('no_gps') }}">
                            @error('no_gps')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Nama gang & lokasi & koordinat -->


                    <!-- Dimensi Jalan Utama -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block m-0 fw-bold mt-2">Dimensi Jalan Utama</label>
                        <div class="col-12 d-flex justify-content-around">
                            <div class="kolom-data m-1">
                                <label for="" class="ms-2">Panjang :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary @error('dimensi_jalan_panjang') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="dimensi_jalan_panjang" value="{{ old('dimensi_jalan_panjang') }}">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">m</span>
                                    @error('dimensi_jalan_panjang')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data m-1">
                                <label for="" class="ms-2">Lebar :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary @error('dimensi_jalan_lebar') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="dimensi_jalan_lebar" value="{{ old('dimensi_jalan_lebar') }}">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">m</span>
                                    @error('dimensi_jalan_lebar')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dimensi Jalan Utama -->


                    <!-- Kondisi jalan -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold m-0">Kondisi Jalan</label>
                        <div class="col-12 d-flex justify-content-around">
                            <div class="kolom-data m-1" style="width: 40%;">
                                <label for="" class="ms-2">Keadaan Jalan :</label>
                                <div class="input-group m-1">
                                    <select
                                        class="form-select form-select border-primary @error('jenis_konstruksi_jalan_id') is-invalid @enderror"
                                        autocomplete="off" style="border-radius: .5em;" aria-label=".form-select example"
                                        name="jenis_konstruksi_jalan_id">
                                        <option value="" selected hidden></option>
                                        @foreach ($jalan as $item)
                                            <option {{ old('jenis_konstruksi_jalan_id') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_konstruksi_jalan_id')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Persentase :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary @error('status_jalan') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="status_jalan" value="{{ old('status_jalan') }}" id="status_jalan">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">%</span>
                                    @error('status_jalan')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Status :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1" id="status_jalanan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kondisi jalan -->


                    <!-- Dimensi Saluran -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold">Dimensi Saluran</label>
                        <div class=" justify-content-center">
                            <div class="row row-cols-2">

                                <div class="col-12 col-sm-6 mb-2">
                                    <p class="m-0 ms-2 fw-light">Panjang</p>
                                    <div class="d-flex col-sm-6">
                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kanan :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_panjang_kanan"
                                                    value="{{ old('dimensi_saluran_panjang_kanan') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_panjang_kiri"
                                                    value="{{ old('dimensi_saluran_panjang_kiri') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 mb-2">
                                    <p class="m-0 ms-2 fw-light">Lebar</p>
                                    <div class="d-flex col-sm-6">
                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">kanan :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_lebar_kanan"
                                                    value="{{ old('dimensi_saluran_lebar_kanan') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_lebar_kiri"
                                                    value="{{ old('dimensi_saluran_lebar_kiri') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <p class="m-0 ms-2 fw-light">Kedalaman</p>
                                    <div class="d-flex">
                                        <div class="col-6 ps-1 pe-1">
                                            <label for="" class="ms-2">kanan :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_kedalaman_kanan"
                                                    value="{{ old('dimensi_saluran_kedalaman_kanan') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_kedalaman_kiri"
                                                    value="{{ old('dimensi_saluran_kedalaman_kiri') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Dimensi Saluran -->


                    <!-- Kondisi Saluran -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold m-0">Kondisi Saluran</label>
                        <div class="col-12 d-flex justify-content-around">
                            <div class="kolom-data m-1" style="width: 40%;">
                                <label for="" class="ms-2">Keadaan Saluran :</label>
                                <div class="input-group m-1">
                                    <select class="form-select form-select border-primary" autocomplete="off"
                                        style="border-radius: .5em;" aria-label=".form-select example"
                                        name="jenis_konstruksi_saluran_id">
                                        <option value="" selected hidden></option>
                                        @foreach ($saluran as $item)
                                            <option
                                                {{ old('jenis_konstruksi_saluran_id') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Persentase :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1" name="status_saluran"
                                        value="{{ old('status_saluran') }}">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">%</span>
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Status :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kondisi Saluran -->


                    <!-- Jenis Fasilitas Sosial -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold m-0 mb-2">Jenis Fasilitas Sosial(Fasos)</label>
                        <button type="button" id="fasos" class="btn btn-primary border-0"
                            style="border-radius: .5em; background: #3F4FC8;">+ Tambah Data Fasos</button>
                    </div>

                    <input type="hidden" name="jmlFasos" id="jmlFasos">
                    <!-- form-tambahan -->
                    <div class="tambah-fasos col-12 p-2 bg-white mb-4" id="form-tambahan"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <div class="form-fasos">
                            <button type="button" id="addFasos" class="btn btn-primary border-0"
                                style="border-radius: .5em; background: #3F4FC8;">+ Tambah Data Fasos</button>
                            <div class="d-flex flex-wrap mb-3">
                                <div class="col-12 col-sm-6 mt-sm-1">
                                    <label for="" class="form-label d-block mb-1 fw-bold">Jenis Fasilitas
                                        Sosial(Fasos)</label>
                                    <select class="form-select form-select border-primary" autocomplete="off"
                                        style="border-radius: .5em;" aria-label=".form-select example"
                                        name="addmore[0][jenis_fasos_id]" value="{{ old('jenis_fasos_id') }}">
                                        <option value="" selected>-Pilih fasos-</option>
                                        @foreach ($fasos as $item)
                                            <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex col-sm-6 justify-content-evenly">
                                    <div class="kolom-data col-5">
                                        <label for="" class="ms-2">Panjang :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-primary"
                                                style="border-radius: .5em;" aria-label="Username"
                                                aria-describedby="basic-addon1" name="addmore[0][panjang]"
                                                value="{{ old('panjang') }}">
                                            <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                                        </div>
                                    </div>

                                    <div class="kolom-data col-5">
                                        <label for="" class="ms-2">Lebar :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-primary"
                                                style="border-radius: .5em;" aria-label="Username"
                                                aria-describedby="basic-addon1" name="addmore[0][lebar]"
                                                value="{{ old('lebar') }}">
                                            <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="input-koordinat-fasos" class="form-label d-block fw-bold">Koordinat
                                    Fasos</label>
                                <div class="col-12 d-flex">
                                    <button type="button" id="koordinat-fasos"
                                        class="lokasi btn btn-primary d-flex align-items-center me-2 border-0 koordinat-fasos"
                                        style="border-radius: .5em; background: #3F4FC8;"><i
                                            class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                                    <input type="text"
                                        class="lokasi-fasos form-control border-primary @error('koordinat_fasos') is-invalid @enderror"
                                        style="border-radius: .5em;" id="input-koordinat-fasos"
                                        name="addmore[0][koordinat_fasos]" value="{{ old('koordinat_fasos') }}">
                                    @error('koordinat_fasos')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="input-lampiran" class="form-label d-block fw-bold">Lampiran Data Fasos</label>
                                <p>Keterangan</p>
                                <select class="form-select form-select border-primary" autocomplete="off"
                                    style="border-radius: .5em;" aria-label=".form-select example">
                                    <option selected disabled>-Pilih kategori-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <input type="file" name="addmore[0][foto]" class="imageFasos btn btn-primary border-0"
                                    style="border-radius: .5em; background: #3F4FC8;" @error('fotoFasos') is-invalid
                                    @enderror>
                                @error('fotoFasos')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="img-keterangan mt-2 p-2 text-sm-center"
                                    style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                                    <img src="/img/kartu-empat.png" id="imageFasos" style="width: 9em;">
                                </div>
                            </div>
                        </div>
                        <button type="button" name="add" id="add" class="btn btn-primary border-0 mt-2 mb-3"
                            style="border-radius: .5em; background: #3F4FC8;">Tambah Lagi</button>
                    </div>
                    <!-- form-tambahan -->


                    <!-- Jumlah rumah -->
                    <div class="col-12 mb-3 ps-2">
                        <label for="" class="form-label d-block fw-bold">Jumlah Rumah</label>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="kolom-data col-3">
                                <label for="" class="">Layak :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_layak" value="{{ old('jumlah_rumah_layak') }}">
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Tidak Layak :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_tak_layak" value="{{ old('jumlah_rumah_tak_layak') }}">
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Kosong :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_kosong" value="{{ old('jumlah_rumah_kosong') }}">
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Jumlah rumah -->

                    <!-- Jenis rumah & pos jaga -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label ms-2 d-block fw-bold">Jenis Rumah</label>
                        <div class=" justify-content-center">
                            <div class="row row-cols-2">

                                <div class="col-12 col-sm-6 mb-2">
                                    <div class="d-flex col-sm-6">
                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Developer :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_rumah_developer"
                                                    value="{{ old('jumlah_rumah_developer') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">Unit</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Swadaya :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_rumah_swadaya"
                                                    value="{{ old('jumlah_rumah_swadaya') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">Unit</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 mb-2">
                                    <div class="d-flex col-sm-12">
                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2 fw-bold">Pos Jaga</label>
                                            <div class="input-group m-1">
                                                <select class="form-select form-select border-primary" autocomplete="off"
                                                    style="border-radius: .5em;" aria-label=".form-select example"
                                                    name="pos_jaga">
                                                    <option value="" selected hidden></option>
                                                    <option {{ old('pos_jaga') == 0 ? 'selected' : '' }} value="0">Tidak
                                                        Ada</option>
                                                    <option {{ old('pos_jaga') == 1 ? 'selected' : '' }} value="1">Ada
                                                    </option>
                                                </select>
                                                {{-- <input type="number" class="border-primary" style="border-radius: .5em;"
                                                    name="pos_jaga"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Jenis rumah & pos jaga -->


                    <!-- Ruko di bagian depan -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label ms-2 d-block fw-bold">Ruko di bagian depan</label>
                        <div class=" justify-content-center">
                            <div class="row row-cols-2">

                                <div class="col-12 col-sm-6 mb-2">
                                    <div class="d-flex col-sm-6">
                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kanan :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_ruko_kanan"
                                                    value="{{ old('jumlah_ruko_kanan') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="lantai_ruko_kanan"
                                                    value="{{ old('lantai_ruko_kanan') }}">
                                                <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">lantai</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_ruko_kiri"
                                                    value="{{ old('jumlah_ruko_kiri') }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="lantai_ruko_kiri"
                                                    value="{{ old('lantai_ruko_kiri') }}">
                                                <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">lantai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Ruko di bagian depan -->


                    <!-- Imb Pendahuluan -->
                    <div class="col-12 mb-3 ps-2">
                        <label for="input-imb" class="form-label fw-bold">No. IMB Pendahuluan</label>
                        <input type="text" class="form-control border-primary" style="border-radius: .5em;" id="input-imb"
                            name="no_imb" value="{{ old('no_imb') }}">
                    </div>
                    <!-- Imb Pendahuluan -->

                    <!-- catatan -->
                    <div class="col-12 ps-2 mb-3">
                        <label for="input-catatan" class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control border-primary" style="border-radius: .5em;" id="input-catatan"
                            style="height: 9em" name="catatan" value="{{ old('catatan') }}"></textarea>
                    </div>
                    <!-- catatan -->


                    <!-- Lampiran Data -->
                    <div class="col-12 ps-2 mb-3">
                        <label for="tambah-lampiran" class="form-label d-block fw-bold m-0 mb-2">Lampiran Data</label>
                        <button type="button" id="tombol-lampiran" class="btn btn-primary border-0"
                            style="border-radius: .5em; background: #3F4FC8;">+ Tambah Lampiran</button>
                    </div>
                    <!-- Lampiran Data -->

                    <!-- tambah lampiran -->
                    <div class="tambah-lampiran col-12 p-2 bg-white mb-5" id="tambah-lampiran"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <div class="form-lampiran">
                            <label for="" class="fw-bold">Keterangan</label>
                            <div class="input-group mb-3">
                                <select class="form-select form-select border-primary" autocomplete="off"
                                    style="border-radius: .5em;" aria-label=".form-select example"
                                    name="addmoreLampiran[0][jenis_lampiran_id]">
                                    <option value="" selected hidden>-Pilih kategori-</option>
                                    @foreach ($lampiran as $item)
                                        <option
                                            {{ old('addmoreLampiran[0][jenis_lampiran_id]') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                {{-- <button type="button" class="btn btn-primary border-0"
                                style="border-radius: .5em; background: #3F4FC8;"><i class="far fa-image pe-1"></i>Pilih
                                Gambar</button> --}}
                                <input type="file" name="addmoreLampiran[0][foto]"
                                    class="imageLampiran btn btn-primary border-0 @error('fotoLampiran') is-invalid @enderror"
                                    style="border-radius: .5em; background: #3F4FC8;">
                                @error('fotoLampiran')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="img-keterangan mt-2 p-2 text-sm-center"
                                    style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                                    <img src="/img/kartu-empat.png" id="imageLampiran" style="width: 9em;">
                                </div>
                            </div>
                            <button type="button" name="addLampiran" id="addLampiran" class="btn btn-primary border-0"
                                style="border-radius: .5em; background: #3F4FC8;">Tambah Lagi</button>
                        </div>
                    </div>
                    <!-- tambah lampiran -->

                    <!-- simpan tombol -->
                    <div class="col-12 ps-2 mb-3 mt-5 d-flex justify-content-center">
                        <button type="submit" id="simpan-lampiran" class="btn btn-primary col-6 border-0"
                            style="border-radius: .5em; background: #3F4FC8;">Simpan</button>
                    </div>
                    <!-- simpan tombol -->
                </form>

            </div>

            <!-- good luck have fun :) -->
        </div>
    </div>
    <script src="/js/tambah-data-user.js"></script>
    <script>
        // fasos
        var i = 0;

        $('#add').click(function() {
            ++i;
            $('#form-tambahan').append(`
                <div class="form-fasos mt-3">
                <div class="d-flex flex-wrap mb-3">
                    <div class="col-12 col-sm-6 mt-sm-1">
                        <label for="" class="form-label d-block mb-1 fw-bold">Jenis Fasilitas
                            Sosial(Fasos)</label>
                        <select class="form-select form-select border-primary" autocomplete="off"
                            style="border-radius: .5em;" aria-label=".form-select example" name="addmore[${i}][jenis_fasos_id]"
                            value="{{ old('jenis_fasos_id') }}">
                            <option value="" selected disabled>-Pilih fasos-</option>
                            @foreach ($fasos as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex col-sm-6 justify-content-evenly">
                        <div class="kolom-data col-5">
                            <label for="" class="ms-2">Panjang :</label>
                            <div class="input-group">
                                <input type="text" class="form-control border-primary"
                                    style="border-radius: .5em;" aria-label="Username"
                                    aria-describedby="basic-addon1" name="addmore[${i}][panjang]"
                                    value="{{ old('panjang') }}">
                                <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                            </div>
                        </div>

                        <div class="kolom-data col-5">
                            <label for="" class="ms-2">Lebar :</label>
                            <div class="input-group">
                                <input type="text" class="form-control border-primary"
                                    style="border-radius: .5em;" aria-label="Username"
                                    aria-describedby="basic-addon1" name="addmore[${i}][lebar]"
                                    value="{{ old('lebar') }}">
                                <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="input-koordinat-fasos" class="form-label d-block fw-bold">Koordinat
                        Fasos</label>
                    <div class="col-12 d-flex">
                        <button type="button" id="koordinat-fasos"
                            class="lokasi btn btn-primary d-flex align-items-center me-2 border-0 koordinat-fasos"
                            style="border-radius: .5em; background: #3F4FC8;""><i
                                class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                        <input type="text"
                            class="lokasi-fasos form-control border-primary @error('koordinat_fasos') is-invalid @enderror"
                            style="border-radius: .5em;" id="input-koordinat-fasos" name="addmore[${i}][koordinat_fasos]"
                            value="{{ old('koordinat_fasos') }}">
                        @error('koordinat_fasos')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="input-lampiran" class="form-label d-block fw-bold">Lampiran Data Fasos</label>
                    <p>Keterangan</p>
                    <select class="form-select form-select border-primary" autocomplete="off"
                        style="border-radius: .5em;" aria-label=".form-select example">
                        <option selected disabled>-Pilih kategori-</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="col-12">
                    <input type="file" name="addmore[${i}][foto]" class="imageFasos btn btn-primary border-0"
                        @error('fotoFasos') is-invalid
                        @enderror>
                    @error('fotoFasos')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="img-keterangan mt-2 p-2 text-sm-center"
                        style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                        <img src="/img/kartu-empat.png" id="imageFasos" style="width: 9em;">
                    </div>
                </div>
                <button type="button" id="close" class="btn btn-primary border-0 mt-3"
            style="border-radius: .5em; background: #3F4FC8;">Exit Fasos</button>
            </div>
            `);
        });

        $(document).on('click', '#close', function() {
            $(this).parents('.form-fasos').remove();
        });
        // $('#jmlFasos').val(i);

        // lampiran
        var i = 0;

        $('#addLampiran').click(function() {
            ++i;
            $('#tambah-lampiran').append(`
            <div class="form-lampiran">
                    <label for="" class="fw-bold">Keterangan</label>
                    <div class="input-group mb-3">
                        <select class="form-select form-select border-primary" autocomplete="off"
                            style="border-radius: .5em;" aria-label=".form-select example"
                            name="addmoreLampiran[${i}][jenis_lampiran_id]" value="{{ old('jenis_lampiran_id') }}">
                            <option value="" selected disabled>-Pilih kategori-</option>
                            @foreach ($lampiran as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        {{-- <button type="button" class="btn btn-primary border-0"
                        style="border-radius: .5em; background: #3F4FC8;"><i class="far fa-image pe-1"></i>Pilih
                        Gambar</button> --}}
                        <input type="file" name="addmoreLampiran[${i}][foto]"
                            class="imageLampiran btn btn-primary border-0 @error('fotoLampiran') is-invalid @enderror"
                            style="border-radius: .5em; background: #3F4FC8;">
                        @error('fotoLampiran')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="img-keterangan mt-2 p-2 text-sm-center"
                            style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                            <img src="/img/kartu-empat.png" id="imageLampiran" style="width: 9em;">
                        </div>
                    </div>
                    <button type="button" id="closeLampiran" class="btn btn-primary border-0"
                        style="border-radius: .5em; background: #3F4FC8;">Exit Lampiran</button>
                </div>
            `);
        });

        $(document).on('click', '#closeLampiran', function() {
            $(this).parents('.form-lampiran').remove();
        });
    </script>
    @include('user.navigation')
@endsection
