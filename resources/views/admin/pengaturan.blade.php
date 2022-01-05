@extends('admin.main')
@section('main-content')
@include('admin.header')
<div class="content d-flex flex-column" id="set-page-content">
    <div class="admin-hl mt-4 ps-sm-0 ms-sm-2 ps-1 text-left text-sm-center">
        <h1>Pengaturan</h1>
        <p class=" text-wrap col-sm-12 col-10">Pengaturan yang mungkin dibutuhkan selama proses survei</p>
    </div>

    <div class="setting d-flex justify-content-evenly mt-3 ms-sm-0 ms-2 position-relative flex-wrap gap-2 gap-sm-3">
        <div class="card d-flex flex-column position-relative col-7" style="width: 20rem;">
            <img src="/img/card1.png" class="card-img-top card1 position-relative" alt="">
            <div class="card-body p-4 pt-0">
                <h5 class="card-title mb-2">Edit Input Data Survei</h5>
                <p class="card-text mb-5">Ubah inputan data survei</p>
                <a href="/pengaturan/edit-data-survey" class="btn btn-primary kartu">Edit Data Survei</a>
            </div>
        </div>

        <div class="card d-flex flex-column position-relative col-7" style="width: 20rem;">
            <img src="/img/card2.png" class="card-img-top card2 position-relative" alt="">
            <div class="card-body p-4 pt-0">
                <h5 class="card-title mb-2">Ubah Password</h5>
                <p class="card-text mb-5">Ubah password Admin</p>
                <a href="/pengaturan/ubah-password" class="btn btn-primary kartu">Ubah Password</a>
            </div>
        </div>
    </div>
</div>
@endsection('main-content')