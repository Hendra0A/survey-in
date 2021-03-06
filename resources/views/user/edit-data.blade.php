@extends('user.main')
@section('header')
    <a href="/surveyor/data-survei/detail/{{ $data->id}}" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
    <span class="fw-bold">Edit Data Survey Gang {{ $data->nama_gang }}</span>
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="content ps-3 pe-3">
                <h1 class="col-12 text-center fs-3 mt-2">Edit Data Survey</h1>
                <p class="col-12 text-center" style="font-size: .9em; color: #A5A5A5;">Silahkan edit data survey dengan
                    lengkap dan benar di bawah ini</p>
                {{-- @dump(old('addmore.0.koordinat_fasos')) --}}
                <form method="POST" enctype="multipart/form-data" class="form-tambah" autocomplete="off">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ request()->id }}">
                    <div class="input-group mb-3">
                        <div class="col-12 mb-3">
                            <label for="kecamatan" class="form-label d-block fw-bold">Kecamatan</label>
                            <input type="hidden" name="kecamatan_id" value="{{ $data->kecamatan_id }}">
                            <span type="text" class="form-control border-primary p-2" style="border-radius: .5em;">{{ $data->kecamatan->nama }}</span>
                            @error('kecamatan_id')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Nama gang & lokasi & koordinat -->
                    <div class="row row-cols-3">
                        <div class="col-12 col-sm-6 mb-3">
                            <label for="nama_gang" class="form-label fw-bold">Nama Gang dan Perumahan</label>
                            <input type="text" class="form-control border-primary @error('nama_gang') is-invalid @enderror"
                                style="border-radius: .5em;" id="nama_gang" name="nama_gang"
                                value="{{ $data->nama_gang }}" required>
                            @error('nama_gang')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                            <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                            <input type="text" class="form-control border-primary @error('lokasi') is-invalid @enderror"
                                style="border-radius: .5em;" id="lokasi" name="lokasi" value="{{ $data->lokasi }}" required>
                            @error('lokasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="input-koordinat" class="form-label fw-bold d-block m-0 mb-2">Koordinat Depan Gang/Komplek </label>
                        <div class="col-12 d-flex">
                            <button type="button" id="koordinat-depan"
                                class="lokasi btn btn-primary d-flex align-items-center me-2 border-0 koordinat-fasos"
                                style="border-radius: .5em; background: #3F4FC8;"><i
                                    class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                            <input type="text" class="form-control border-primary @error('no_gps_depan') is-invalid @enderror"
                                style="border-radius: .5em;" id="input-koordinat-depan" name="no_gps_depan"
                                value="{{ $data->no_gps_depan}}" required>
                            @error('no_gps')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="input-koordinat" class="form-label fw-bold d-block m-0 mb-2">Koordinat Belakang Gang/Komplek </label>
                        <div class="col-12 d-flex">
                            <button type="button" id="koordinat-belakang"
                                class="lokasi btn btn-primary d-flex align-items-center me-2 border-0 koordinat-fasos"
                                style="border-radius: .5em; background: #3F4FC8;"><i
                                    class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                            <input type="text" class="form-control border-primary @error('no_gps_belakang') is-invalid @enderror"
                                style="border-radius: .5em;" id="input-koordinat-belakang" name="no_gps_belakang"
                                value="{{  $data->no_gps_belakang}}" required>
                            @error('no_gps')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Nama gang & lokasi & koordinat -->
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
                                        name="jenis_konstruksi_jalan_id" required>
                                        <option value="" selected hidden></option>
                                        @foreach ($jalan as $item)
                                            <option {{ $data->jenis_konstruksi_jalan_id == $item->id ? 'selected' : '' }}
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
                                        name="status_jalan" value="{{ $data->status_jalan }}" id="status_jalan" required>
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
                                        aria-label="Username" aria-describedby="basic-addon1" id="status_jalanan" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kondisi jalan -->
                    <!-- Dimensi Jalan Utama -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block m-0 fw-bold mt-2">Dimensi Jalan Utama</label>
                        <div class="col-12 d-flex justify-content-around justify-content-sm-between">
                            <div class="kolom-data m-1 col-sm-5">
                                <label for="" class="ms-2">Panjang :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary @error('dimensi_jalan_panjang') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="dimensi_jalan_panjang" value="{{ $data->dimensi_jalan_panjang }}" required>
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">m</span>
                                    @error('dimensi_jalan_panjang')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data m-1 col-sm-5">
                                <label for="" class="ms-2">Lebar :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary @error('dimensi_jalan_lebar') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="dimensi_jalan_lebar" value="{{ $data->dimensi_jalan_lebar }}" required>
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


                    

                     <!-- Kondisi Saluran -->
                     <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold m-0">Kondisi Saluran</label>
                        <div class="col-12 d-flex justify-content-around">
                            <div class="kolom-data m-1" style="width: 40%;">
                                <label for="" class="ms-2">Keadaan Saluran :</label>
                                <div class="input-group m-1">
                                    <select class="form-select form-select border-primary" autocomplete="off"
                                        style="border-radius: .5em;" aria-label=".form-select example"
                                        name="jenis_konstruksi_saluran_id" id="keadaan-saluran">
                                        <option value="">Tidak Ada</option>
                                        @foreach ($saluran as $item)
                                            <option
                                                {{ $data->jenis_konstruksi_saluran_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Persentase :</label>
                                <div class="input-group m-1">
                                    <input type="text"
                                        class="form-control border-primary status_saluran @error('status_saluran') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="status_saluran" value="{{ $data->status_saluran }}" id="status_saluran">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">%</span>
                                    @error('status_saluran')
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
                                        aria-label="Username" aria-describedby="basic-addon1" id="status_salurann" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kondisi Saluran -->
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
                                                <input type="text"
                                                    class="form-control border-primary pj_saluran_kanan @error('dimensi_saluran_panjang_kanan') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_panjang_kanan"
                                                    value="{{ $data->dimensi_saluran_panjang_kanan }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_panjang_kanan')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary pj_saluran_kiri @error('dimensi_saluran_panjang_kiri') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_panjang_kiri"
                                                    value="{{ $data->dimensi_saluran_panjang_kiri }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_panjang_kiri')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                <input type="text"
                                                    class="form-control border-primary lb_saluran_kanan @error('dimensi_saluran_lebar_kanan') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_lebar_kanan"
                                                    value="{{ $data->dimensi_saluran_lebar_kanan }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_lebar_kanan')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary lb_saluran_kiri @error('dimensi_saluran_lebar_kiri') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_lebar_kiri"
                                                    value="{{ $data->dimensi_saluran_lebar_kiri }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_lebar_kiri')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                <input type="text"
                                                    class="form-control border-primary kdl_saluran_kanan @error('dimensi_saluran_kedalaman_kanan') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_kedalaman_kanan"
                                                    value="{{ $data->dimensi_saluran_kedalaman_kanan }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_kedalaman_kanan')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary kdl_saluran_kiri @error('dimensi_saluran_kedalaman_kiri') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="dimensi_saluran_kedalaman_kiri"
                                                    value="{{ $data->dimensi_saluran_kedalaman_kiri }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                                @error('dimensi_saluran_kedalaman_kiri')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Dimensi Saluran -->


                   


                    <!-- Jenis Fasilitas Sosial -->
                    <div class="col-12 mb-3">
                        <label for="" class="form-label d-block fw-bold m-0 mb-2">Jenis Fasilitas Sosial(Fasos)</label>
                        <button type="button" id="fasos" class="btn btn-primary border-0"
                            style="border-radius: .5em; background: #3F4FC8;">+ Tambah Data Fasos</button>
                    </div>

                    <input type="hidden" name="jmlFasos" id="jmlFasos">
                    <!-- form-tambahan -->
                    <div class="tambah-fasos col-12 p-2 bg-white mb-4" id="form-tambahan" class="form-tambahan"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <div class="form-fasos mt-3">
                        </div>
                    </div>
                    <!-- form-tambahan -->


                    <!-- Jumlah rumah -->
                    <div class="col-12 mb-3 ps-2">
                        <label for="" class="form-label d-block fw-bold">Jumlah Rumah</label>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="kolom-data col-3">
                                <label for="" class="">Layak :</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control border-primary ps-1 pe-1 @error('jumlah_rumah_layak') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_layak" value="{{ $data->jumlah_rumah_layak }}" required>
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                    @error('jumlah_rumah_layak')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Tidak Layak :</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control border-primary ps-1 pe-1 @error('jumlah_rumah_tak_layak') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_tak_layak" value="{{ $data->jumlah_rumah_tak_layak }}" required>
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                    @error('jumlah_rumah_tak_layak')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Kosong :</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control border-primary ps-1 pe-1 @error('jumlah_rumah_kosong') is-invalid @enderror"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1"
                                        name="jumlah_rumah_kosong" value="{{ $data->jumlah_rumah_kosong }}" required>
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                    @error('jumlah_rumah_kosong')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                                                <input type="text"
                                                    class="form-control border-primary @error('jumlah_rumah_developer') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_rumah_developer"
                                                    value="{{ $data->jumlah_rumah_developer }}" required>
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">Unit</span>
                                                @error('jumlah_rumah_developer')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Swadaya :</label>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary @error('jumlah_rumah_swadaya') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_rumah_swadaya"
                                                    value="{{ $data->jumlah_rumah_swadaya }}" required>
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">Unit</span>
                                                @error('jumlah_rumah_swadaya')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                    <option value="" selected disabled></option>
                                                    <option {{ $data->pos_jaga == 0 ? 'selected' : '' }} value="0">Tidak
                                                        Ada</option>
                                                    <option {{ $data->pos_jaga == 1 ? 'selected' : '' }} value="1">Ada
                                                    </option>
                                                </select>
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
                                                <input type="text"
                                                    class="form-control border-primary @error('jumlah_ruko_kanan') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_ruko_kanan"
                                                    value="{{ $data->jumlah_ruko_kanan }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                                @error('jumlah_ruko_kanan')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary @error('lantai_ruko_kanan') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="lantai_ruko_kanan"
                                                    value="{{ $data->lantai_ruko_kanan }}">
                                                <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">lantai</span>
                                                @error('lantai_ruko_kanan')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary @error('jumlah_ruko_kiri') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="jumlah_ruko_kiri"
                                                    value="{{ $data->jumlah_ruko_kiri }}">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                                @error('jumlah_ruko_kiri')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text"
                                                    class="form-control border-primary @error('lantai_ruko_kiri') is-invalid @enderror"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="lantai_ruko_kiri"
                                                    value="{{ $data->lantai_ruko_kiri }}">
                                                <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">lantai</span>
                                                @error('lantai_ruko_kiri')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                            name="no_imb" value="{{ $data->no_imb }}">
                    </div>
                    <!-- Imb Pendahuluan -->

                    <!-- catatan -->
                    <div class="col-12 ps-2 mb-3">
                        <label for="input-catatan" class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control" style="border-radius: .5em; border: 1px solid #3F4FC8;"
                            id="input-catatan" style="height: 9em" name="catatan">{{ $data->catatan }}</textarea>
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
                    <input type="hidden" name="jmlLampiran" id="jmlLampiran">
                    <div class="tambah-lampiran col-12 p-2 bg-white mb-5" id="tambah-lampiran"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <div class="form-lampiran mt-3">
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

        </div>
    </div>
    <script type="text/javascript">
        var url = '{{ URL::asset('storage/') }}';
    </script>
    <script src="{{ asset('js/renderFormEdit.js') }}"></script>
    <script src="/js/tambah-data-user.js"></script>
    @include('user.navigation')
@endsection
