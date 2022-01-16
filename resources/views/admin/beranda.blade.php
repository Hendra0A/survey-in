@extends('admin.main')
@section('title','Beranda')
@section('main-content')
    @include('admin.header')
    <div class="content d-flex flex-column" id="beranda-content">
        <div class="pilih w-100 d-flex flex-column container-fluid ">
            <div class=" justify-content-around my-3 col-12 d-flex flex-column flex-sm-row">
                <div class="col-sm-5 col-12 ">
                    <div class="input-group mb-3">
                        <label class="input-group-text fw-bold" for="kabupaten">Kabupaten/Kota</label>
                        <select class="form-select" id="kabupaten" name="kabupaten">
                          <option selected>Pilih kota/kabupaten<</option>
                          @foreach ($kabupaten as $kab)
                              <option value="{{ $kab->id }}" {{ ($kab->id==13)?'selected' :''}}>{{ $kab->nama }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5 col-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text fw-bold" for="kecamatan">Kecamatan</label>
                        <select class="form-select" id="kecamatan" name="kecamatan">
                            <option value="" selected> Pilih kabupaten</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="survei-stat container-fluid mb-5">
                <h1 class="beranda text-center">
                    Hasil Survei Saat Ini
                </h1>
                <p class="beranda text-center">
                    Dibawah ini adalah hasil survei sementara di<br>Kecamatan <span class="text-kec">Pontianak Barat</span>
                </p>
                <div class="row mt-5 justify-content-center gap-4">
                    <div class="kartu satu col-4">
                        <h3 class="kartu border-0 p-0 text-center w-100">Gang dan Perumahan</h3>
                        <div class="kartu-img d-flex flex-row align-items-center">
                            <img src="img/kartu-satu.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="jmlGang"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Jumlah Gang dan Perumahan yang Ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                    
                    <div class="kartu dua col-4">
                        <h3 class="kartu border-0 p-0 mb-3 text-center w-100">Kondisi Jalan Baik</h3>
                        <div class="kartu-img mb-3 d-flex flex-row align-items-center">
                            <img src="img/kartu-dua.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="jlnBaik"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Kondisi jalan baik yang ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                    <div class="kartu tiga col-4">
                        <h3 class="kartu border-0 p-0 mb-3 text-center w-100">Kondisi Jalan Tidak Baik</h3>
                        <div class="kartu-img mb-3 d-flex flex-row align-items-center">
                            <img src="img/kartu-tiga.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="jlnJelek"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Kondisi jalan rusak yang ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                    <div class="kartu empat col-4">
                        <h3 class="kartu border-0 p-0 mb-3 text-center w-100">Jumlah Rumah</h3>
                        <div class="kartu-img mb-3 d-flex flex-row align-items-center">
                            <img src="img/kartu-empat.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="jmlRumah"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Jumlah Rumah yang Ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                    <div class="kartu lima col-4">
                        <h3 class="kartu border-0 mb-3 p-0 text-center w-100">Panjang Jalan Perumahan</h3>
                        <div class="kartu-img mb-3 d-flex flex-row align-items-center">
                            <img src="img/kartu-lima.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="pnjJalan"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Panjang Jalan Perumahan yang Ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                    <div class="kartu enam col-4">
                        <h3 class="kartu border-0 mb-3 p-0 text-center w-100">Lebar Jalan Perumahan</h3>
                        <div class="kartu-img mb-3 d-flex flex-row align-items-center">
                            <img src="img/kartu-enam.png" style="width: 70px;" alt="">
                            <p class="kartu mb-0 ms-3" id="lbrJalan"></p>
                        </div>
                        <p class="sub-kartu mb-0 mt-2">Lebar Jalan Perumahan yang Ada di Kecamatan <span class="text-kec">Pontianak Barat</span>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/beranda.js"></script>
@endsection('main-content')