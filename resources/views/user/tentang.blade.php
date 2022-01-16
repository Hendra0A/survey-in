@extends('user.main')
@section('header')
    <a href="/surveyor/beranda" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
    <span class="fw-bold">Tentang</span>
@endsection
@section('content')
    <div class="content">
        <div class="container vh-100">

            <div class="about mt-5 p-3 pt-5 bg-white d-flex flex-column align-items-center col-12"
                style="border-radius: 1em; box-shadow: 0px 0px 4px gray;">
                <img src="/img/logo-b.png" alt="" class="mb-3" style="width: 6em;">
                <h1 class="fw-bold" style="color: #F8B94A; margin-bottom: 2em; letter-spacing: .05em;">Survei</h1>
                <h6 class="fw-bold mb-4">Aplikasi Survei</h6>
                <p class="text-center col-11" style="letter-spacing: 0.001em; line-height: 24px; color: #A5A5A5;">Aplikasi
                    Survei merupakan aplikasi yang memudahkan para surveyor (penyurvei) di Dinas PUPR Kalimantan Barat untuk
                    menyimpan data survei. Aplikasi Survei menawarkan berbagai fitur yang memudahkan Anda melakukan survei
                    di lapangan.</p>
            </div>
            <!-- good luck have fun :) -->
        </div>
    </div>
@endsection
