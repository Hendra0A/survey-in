@extends('admin.main')
@section('title','Profil')
@section('main-content')
    @include('admin.header')
    <div class="content d-flex flex-column ms-sm-1 ps-sm-1 ms-0 ps-0" id="prf-page-content">
        <div class="admin-hl mt-4">
            <h1>Profil Admin</h1>
            <p>Profil Admin berisi data pribadi Admin.</p>
            <div class="admin d-flex">
                @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="aw" class="hl-img rounded-circle">
                  @else
                  <img src="/img/profile.png" alt="" class="hl-img rounded-circle">
                  @endif
                <div class="hl-status ms-4 d-flex flex-column justify-content-center">
                    <h3>{{ $data->nama_lengkap }}</h3>
                    <p>{{ $data->role }}</p>
                </div>
            </div>
        </div>
        <div class="biodata mt-5 m-auto">
            <table class="bio m-auto" style="width: 90%;">
                <tr>
                    <td class="left-bio p-2" style="vertical-align: top;">Nama Lengkap</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $data->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2" style="vertical-align: top;">Email</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $data->email }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2" style="vertical-align: top;">Tanggal Lahir</td>
                    {{-- <td class="bio-center">:</td> --}}
                <td class="right-bio p-2">: {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('j F Y') }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2" style="vertical-align: top;">Jenis Kelamin</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $data->gender }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2" style="vertical-align: top;">No. Handphone</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $data->nomor_telepon }}</td>
                </tr>
                <tr style="border: none;">
                    <td class="left-bio p-2" style="vertical-align: top;">Alamat</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">: {{ $data->alamat }}</td>
                </tr>
            </table>
        </div>
        <div class="submit d-flex justify-content-center mt-5">
            <a href="/profile/edit-profile/admin" class="text-light text-decoration-none btn btn-lg btn-primary active mb-5 shadow-none h-auto border-0" id="submit">Edit profil</a>
        </div>
    </div>
@endsection
