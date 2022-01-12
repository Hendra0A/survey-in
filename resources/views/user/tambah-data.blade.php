@extends('user.main')
@section('header')
    <a href="/surveyor/beranda" class="nav-link"><i class="fas fa-chevron-left text-black"></i></a>
    <span class="fw-bold">Tambah Data</span>
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="content ps-3 pe-3">
                <h1 class="col-12 text-center fs-3 mt-2">Tambah Data Survei</h1>
                <p class="col-12 text-center" style="font-size: .9em; color: #A5A5A5;">Silahkan tambah data survei dengan
                    lengkap dan benar di bawah ini</p>

                <form class="form-tambah" autocomplete="off">

                    <!-- Nama gang & lokasi & koordinat -->
                    <div class="row row-cols-3">
                        <div class="col-12 col-sm-6 mb-3">
                            <label for="input-gang" class="form-label fw-bold">Nama Gang dan Perumahan</label>
                            <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                id="input-gang">
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                            <label for="input-lokasi" class="form-label fw-bold">Lokasi</label>
                            <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                id="input-lokasi">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="input-gang" class="form-label fw-bold d-block m-0 mb-2">Koordinat</label>
                        <div class="col-12 d-flex">
                            <button type="button" id="koordinat"
                                class="btn btn-primary d-flex align-items-center me-2 border-0"
                                style="border-radius: .5em; background: #3F4FC8;"><i
                                    class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                            <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                id="input-koordinat">
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
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">m</span>
                                </div>
                            </div>

                            <div class="kolom-data m-1">
                                <label for="" class="ms-2">Lebar :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">m</span>
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
                                    <select class="form-select form-select border-primary" autocomplete="off"
                                        style="border-radius: .5em;" aria-label=".form-select example">
                                        <option selected disabled></option>
                                        <option value="1">Aspal</option>
                                        <option value="2">Beton</option>
                                        <option value="3">Tanah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Persentase :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1">
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
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
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
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
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
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">m</span>
                                            </div>
                                        </div>

                                        <div class="col-6 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
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
                                        style="border-radius: .5em;" aria-label=".form-select example">
                                        <option selected disabled></option>
                                        <option value="1">Cor Beton</option>
                                        <option value="2">Tanah</option>
                                        <option value="3">Berbatu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="kolom-data m-1" style="width: 30%;">
                                <label for="" class="ms-2">Persentase :</label>
                                <div class="input-group m-1">
                                    <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                        aria-label="Username" aria-describedby="basic-addon1">
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
                        <button type="button" onclick="myForm()" id="fasos" class="btn btn-primary border-0"
                            style="border-radius: .5em; background: #3F4FC8;">+ Tambah Data Fasos</button>
                    </div>

                    <!-- form-tambahan -->
                    <div class="tambah-fasos col-12 p-2 bg-white mb-4" id="form-tambahan"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <div class="d-flex flex-wrap mb-3">
                            <div class="col-12 col-sm-6 mt-sm-1">
                                <label for="" class="form-label d-block mb-1 fw-bold">Jenis Fasilitas Sosial(Fasos)</label>
                                <select class="form-select form-select border-primary" autocomplete="off"
                                    style="border-radius: .5em;" aria-label=".form-select example">
                                    <option selected disabled>-Pilih fasos-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="d-flex col-sm-6 justify-content-evenly">
                                <div class="kolom-data col-5">
                                    <label for="" class="ms-2">Panjang :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                        <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                                    </div>
                                </div>

                                <div class="kolom-data col-5">
                                    <label for="" class="ms-2">Lebar :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                        <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="input-koordinat-fasos" class="form-label d-block fw-bold">Koordinat Fasos</label>
                            <div class="col-12 d-flex">
                                <button type="button" id="koordinat-fasos"
                                    class="btn btn-primary d-flex align-items-center me-2 border-0"
                                    style="border-radius: .5em; background: #3F4FC8;"><i
                                        class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
                                <input type="text" class="form-control border-primary" style="border-radius: .5em;"
                                    id="input-koordinat-fasos">
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
                            <button type="button" class="btn btn-primary border-0"
                                style="border-radius: .5em; background: #3F4FC8;"><i class="far fa-image pe-1"></i>Pilih
                                Gambar</button>
                            <div class="img-keterangan mt-2 p-2 text-sm-center"
                                style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                                <img src="img/kartu-empat.png" alt="" style="width: 9em;">
                            </div>
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
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Tidak Layak :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1">
                                    <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                        id="basic-addon1">unit</span>
                                </div>
                            </div>

                            <div class="kolom-data col-3">
                                <label for="" class="">Kosong :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary ps-1 pe-1"
                                        style="border-radius: .5em;" aria-label="Username" aria-describedby="basic-addon1">
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
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">Unit</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Swadaya :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
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
                                                    style="border-radius: .5em;" aria-label=".form-select example">
                                                    <option selected disabled></option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
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
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text p-1 border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">lantai</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-12 ps-1 pe-1">
                                            <label for="" class="ms-2">Kiri :</label>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                <span class="input-group-text border-0" style="background: #F3F8FF;"
                                                    id="basic-addon1">unit</span>
                                            </div>
                                            <div class="input-group m-1">
                                                <input type="text" class="form-control border-primary"
                                                    style="border-radius: .5em;" aria-label="Username"
                                                    aria-describedby="basic-addon1">
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
                        <input type="text" class="form-control border-primary" style="border-radius: .5em;" id="input-imb">
                    </div>
                    <!-- Imb Pendahuluan -->

                    <!-- catatan -->
                    <div class="col-12 ps-2 mb-3">
                        <label for="input-catatan" class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control border-primary" style="border-radius: .5em;" id="input-catatan"
                            style="height: 9em"></textarea>
                    </div>
                    <!-- catatan -->


                    <!-- Lampiran Data -->
                    <div class="col-12 ps-2 mb-3">
                        <label for="tambah-lampiran" class="form-label d-block fw-bold m-0 mb-2">Lampiran Data</label>
                        <button type="button" onclick="myLampiran()" id="tombol-lampiran" class="btn btn-primary border-0"
                            style="border-radius: .5em; background: #3F4FC8;">+ Tambah Lampiran</button>
                    </div>
                    <!-- Lampiran Data -->

                    <!-- tambah lampiran -->
                    <div class="tambah-lampiran col-12 p-2 bg-white mb-5" id="tambah-lampiran"
                        style="border-radius: .5em; box-shadow: 0px 0px 5px gray;">
                        <label for="" class="fw-bold">Keterangan</label>
                        <div class="input-group mb-3">
                            <select class="form-select form-select border-primary" autocomplete="off"
                                style="border-radius: .5em;" aria-label=".form-select example">
                                <option selected disabled>-Pilih kategori-</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn btn-primary border-0"
                                style="border-radius: .5em; background: #3F4FC8;"><i class="far fa-image pe-1"></i>Pilih
                                Gambar</button>
                            <div class="img-keterangan mt-2 p-2 text-sm-center"
                                style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
                                <img src="img/kartu-empat.png" alt="" style="width: 9em;">
                            </div>
                        </div>
                    </div>
                    <!-- tambah lampiran -->

                    <!-- simpan tombol -->
                    <div class="col-12 ps-2 mb-3 mt-5 d-flex justify-content-center">
                        <button type="button" id="simpan-lampiran" class="btn btn-primary col-6 border-0"
                            style="border-radius: .5em; background: #3F4FC8;">Simpan</button>
                    </div>
                    <!-- simpan tombol -->
                </form>

            </div>

            <!-- good luck have fun :) -->
        </div>
    </div>
    @include('user.navigation')
@endsection
