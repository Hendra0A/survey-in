@extends('admin.main')
@section('title','Profile')
@section('main-content')
    @include('admin.header')
    <div class="content d-flex flex-column ms-sm-1 ps-sm-1 ms-0 ps-0" id="prf-page-content">
        <div class="admin-hl mt-4">
            <h1>Profil Admin</h1>
            <p>Profil Admin berisi data pribadi Admin.</p>
            <div class="admin d-flex">
                <img src="{{ auth()->user()->avatar }}" alt="aw" class="hl-img rounded-circle">
                <div class="hl-status ms-4 d-flex flex-column justify-content-center">
                    <h3>{{ auth()->user()->nama_lengkap }}</h3>
                    <p>{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
        <div class="biodata mt-5 m-auto">
            <table class="bio m-auto" style="width: 90%;">
                <tr>
                    <td class="left-bio p-2">Nama Lengkap</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Email</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Tanggal Lahir</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Jenis Kelamin</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->gender }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">No. Handphone</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->nomor_telepon }}</td>
                </tr>
                <tr style="border: none;">
                    <td class="left-bio p-2">Alamat</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ auth()->user()->alamat }}</td>
                </tr>
            </table>
        </div>
        <div class="submit d-flex justify-content-center mt-5">
            <a href="/profile/edit-profile/admin" class="text-light text-decoration-none btn btn-lg btn-primary active mb-5 shadow-none" id="submit">Edit profil</a>
            
        </div>
    </div>
@endsection
