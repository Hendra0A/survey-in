@extends('user.main')
@section('content')
    <div class="content">
        <div class="container">
            <h1 class="mt-2">Profil Surveyor</h1>
            <p style="color: #a5a5a5;">Profil User berisi data pribadi Surveyor.</p>
            <div class="admin d-flex mt-4">
                @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="aw" class="hl-img rounded-circle col-3 col-md-2">
                  @else
                  <img src="/img/profile.png" alt="" class="hl-img rounded-circle col-3 col-md-2">
                  @endif
                <div class="hl-status ms-4 d-flex flex-column justify-content-center col-9">
                    <h3>{{ $data->nama_lengkap }}</h3>
                    <p style="color: #a5a5a5; font-size: 1.2em;">{{ $data->role }}</p>
                </div>
            </div>
            <div class="biodata mt-4 mx-auto bg-white p-1" style="border-radius: 1em; box-shadow: 0px 0px 4px gray;">
                <table class="profil-tb mt-2 col-12" style="border-collapse: collapse;">
                    <tr>
                        <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">Nama Lengkap</td>
                        <td class="right-bio p-2">: {{ $data->nama_lengkap }}</td>
                    </tr>
                    <tr>
                         <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">Email</td>
                        <td class="right-bio p-2">: {{ $data->email }}</td>
                    </tr>
                    <tr>
                         <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">Tanggal Lahir</td>
                        <td class="right-bio p-2">: {{ $data->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                         <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">Jenis Kelamin</th>
                        <td class="right-bio p-2">: {{ $data->gender }}</td>
                    </tr>
                    <tr>
                         <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">No. Handphone</td>
                        <td class="right-bio p-2">: {{ $data->nomor_telepon }}</td>
                    </tr>
                    <tr style="border: none;">
                         <th class="left-bio p-3"  style="font-size: .8em; width: 40%; vertical-align: top;">Alamat</th>
                        <td class="right-bio p-2">: {{ $data->alamat }}</td>
                    </tr>
                </table>
            </div>
            <div class="submit d-flex justify-content-center mt-5">
                <a href="/surveyor/profile/edit-profile" class="text-light text-decoration-none btn btn-lg btn-primary active mb-5 shadow-none" id="submit">Edit profil</a> 
            </div>
        </div>
    </div>
@include('user.navigation')
@endsection
