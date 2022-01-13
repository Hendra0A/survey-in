@extends('user.main')
@section('content')
<div class="content">   
    <div class="container">
      <div class="admin-hl-andro d-flex align-items-center mt-4 ms-3">
        @if (auth()->user()->avatar)
        <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="" class=" rounded-circle ms-2" style="width: 3em;">
          @else
          <img src="/img/profile.png" alt="" class=" rounded-circle ms-2" style="width: 3em;">
          @endif
          <h6 class=" d-flex align-items-center m-0 ms-2">Halo, {{ auth()->user()->nama_lengkap }} <img src="/img/hello.png" alt="" style="width: 1.5em;" class=" ms-1"> </h6>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 ">
          <div class="d-flex ms-2 me-2 mt-2 m-auto justify-content-center shadow-sm bg-white p-3 justify-content-md-between">
              <div class="pe-1 d-flex flex-column justify-content-center">
                  <h4>Ayo selesaikan target surveimu!</h4>
                  <p class="mb-2">Kecamatan {{ $data['kecamatan']['nama'] }}</p>
                  <p class=" text-primary mb-2">Status : {{ $data['selesai'] }}/{{ $data['target'] }} Survei</p>
                  <p class=" text-danger">Deadline :  {{ $data['tanggal_selesai'] }}</p>
              </div>
              <div class="hero-beranda">
                  <img src="/img/beranda-hero.png" style="width: 7em;">
              </div>
          </div>
        </div>
      </div>
      <div class="ms-2 me-2 mt-2 m-auto justify-content-center" style="background: #F3F8FF;">
        <a href="/surveyor/riwayat-survei" class="text-end text-decoration-none fs-6 d-block">Riwayat Survei</a>
      </div>
      <div class="pilih-kec mt-4 mb-2 p-2">
          <label for="" class=" ms-4" id="pilih-kec">Kecamatan :</label>
          <select id="kecamatan" class="form-select form-select-sm m-auto shadow-none border-primary mt-1" style="width: 92%;" aria-label=".form-select-sm example">
              @foreach ($area_survei->kecamatan as $kecamatan)    
                  <option value="{{ $kecamatan->id }}" {{ ($data['kecamatan_id']==$kecamatan->id)?'selected' : '' }}>{{ $kecamatan->nama }}</option>
              @endforeach
          </select>
      </div>
      <div class="row justify-content-evenly mt-5 mb-4">
        <div class="col-6 col-md-4">
          <div class="kartu satu p-2" style=" background: #6E86B4;">
            <div class="kartu-hero d-flex justify-content-center align-items-center ">
              <img src="/img/kartu-satu.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2" id="jmlGang">-</p>
            </div>
            <h6 class=" m-0 mb-1">Gang dan Perumahan</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="kartu dua p-2" style=" background: #849C95;">
            <div class="kartu-hero d-flex justify-content-center align-items-center pt-1">
              <img src="/img/kartu-dua.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2" id="jlnBaik">-</p>
            </div>
            <h6 class=" m-0 mb-1 mt-1">Kondisi Jalan Baik</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="kartu tiga p-2" style=" background: #EB7A7A;">
            <div class="kartu-hero d-flex justify-content-center align-items-center pt-1">
              <img src="/img/kartu-tiga.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2" id="jlnJelek">-</p>
            </div>
            <h6 class=" m-0 mb-1 mt-1">Kondisi Jalan Tidak Baik</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="kartu empat p-2" style=" background: #648360;">
            <div class="kartu-hero d-flex justify-content-center align-items-center">
              <img src="/img/kartu-empat.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2" id="jmlRumah">-</p>
            </div>
            <h6 class=" m-0 mb-1 mt-2">Jumlah Rumah</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
        <div class="col-6 col-md-4 ">
          <div class="kartu lima p-2" style=" background: #9E82A8;">
            <div class="kartu-hero d-flex justify-content-center align-items-center ps-1">
              <img src="/img/kartu-lima.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2 text-wrap" id="pnjJalan">-</p>
            </div>
            <h6 class="m-0 mb-1 mt-1">Panjang Jalan Perumahan</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="kartu enam p-2" style=" background: #9AA55C;">
            <div class="kartu-hero d-flex justify-content-center align-items-center ps-1">
              <img src="/img/kartu-enam.png" alt="" style="width: 30%;">
              <p class="m-0 ms-2 text-wrap" id="lbrJalan">-</p>
            </div>
            <h6 class=" m-0 mb-1 mt-1">Lebar Jalan Perumahan</h6>
            <p class="mb-0">di Kecamatan <span class="text-kec">{{ $data['kecamatan']['nama'] }}</span></p>
          </div>
        </div>
      </div>
    </div>
    <script src="/js/beranda-user.js"></script>
</div>
@include('user.navigation')
@endsection