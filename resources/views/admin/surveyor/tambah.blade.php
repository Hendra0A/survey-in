@extends('admin.main')
@section('title','Surveyor')
@section('main-content')
@include('admin.header')
{{-- content --}}
<div class="content ms-md-5">
    <div class="surveyor-hl ms-5l">
        <h1>Tambah Akun Surveyor</h1>
        <p class="mb-5">Isi data akun surveyor di bawah ini dengan benar</p>
    </div>

    <form method="POST" action="tambah" class="bio-edit d-flex flex-row mt-4" autocomplete="off">
        @csrf
        <div class="bio-left col-12 col-md-6">
            <div class="col-md-8 mb-3 w-100">
                <label for="validationServer03" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                    name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="masukkan nama">
                @error('nama_lengkap')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 mb-3 w-100">
                <label for="validationServer03" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" placeholder="masukkan email">
                @error('email')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 mb-3 w-100">
                <label for="validationServer03" class="form-label">No Handphone</label>
                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon"
                    name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="+62/08 xxx xxx xxx">
                @error('nomor_telepon')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 mb-3 w-100">
                <label for="validationServer03" class="form-label">Area Survey</label>
                <select class="form-select @error('area') is-invalid @enderror" id="area" name="area">
                    <option selected disabled>--Pilih Kabupaten/Kota--</option>
                    @foreach ($kabupaten as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('area')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="tambah-akun d-flex justify-content-end mt-4">
                <a href="/surveyor" class="btn btn-lg mb-5 fs-6" id="batal">Batal</a>

                <button type="submit" class="btn btn-lg btn-primary mb-5 ms-3 fs-6"
                    id="tambah-akun-surveyor">Tambahkan</button>
            </div>
        </div>
    </form>

</div>
@endsection