@extends('admin.main')
@section('title','Profile')
@section('main-content')
    @include('admin.header')

    <div class="content d-flex flex-column" id="prf-page-content">
        <div class="admin-hl mt-4 ps-sm-5 ms-sm-2 ps-1">
            <h1>Profile Admin</h1>

            <p>Profil Admin berisi data pribadi Admin.</p>
            <div class="admin d-flex">
                <img src="{{ $profile->avatar }}" alt="aw" class="hl-img rounded-circle">
                <div class="hl-status ms-4 d-flex flex-column justify-content-center">
                    <h3>{{ ucwords($profile->nama_lengkap) }}</h3>
                    <p>{{ ucwords($profile->role) }}</p>
                </div>
            </div>
        </div>
        <div class="biodata mt-5 m-auto">
            <table class="bio m-auto" style="width: 90%;">
                <tr>
                    <td class="left-bio p-2">Nama Lengkap</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ ucwords($profile->nama_lengkap) }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Email</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $profile->email }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Jenis Kelamin</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ ucwords($profile->gender) }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">No. Handphone</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $profile->nomor_telepon }}</td>
                </tr>
                <tr style="border: none;">
                    <td class="left-bio p-2">Alamat</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $profile->alamat }}</td>
                </tr>
            </table>
        </div>
        <div class="submit d-flex justify-content-center mt-5">
            <a href="/profile/edit-profile/admin" class="text-light text-decoration-none btn btn-lg btn-primary active mb-5 shadow-none" id="submit">Edit profil</a>
            
        </div>
    </div>
@endsection
