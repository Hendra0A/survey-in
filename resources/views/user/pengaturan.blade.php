@extends('user.main')
@section('header')
  <a href="/surveyor/beranda" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
  <span class="fw-bold">Pengaturan</span>
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="pengaturan-menu col-12 d-flex mt-3 justify-content-center">
                <div class="card bg-white p-4 col-10 col-sm-8 d-flex flex-column align-items-sm-center"
                    style="border-radius: 1em; box-shadow: 0px 0px 2px gray;">
                    <img src="/img/password.png" alt="">
                    <h4 class="mt-2 fs-5 fw-bold">Edit Password</h4>
                    <p class="" style="color: #A5A5A5;">Ubah password anda demi keamanan privasi Anda</p>
                    <a href="pengaturan/edit-password" class="btn btn-primary"
                        style="border: none; border-radius: .5em; background: #3F4FC8;">Edit Password</a>
                </div>
            </div>

            <!-- good luck have fun :) -->
        </div>
    </div>
@endsection