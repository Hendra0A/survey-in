@extends('admin.main')
@section('title','Surveyor')
@section('main-content')
@include('admin.header')
<!-- content -->
<div class="content d-flex flex-column">
    <div class="surveyor-hl ms-0 ms-sm-5">
        <h1>Tambah Target Surveyor</h1>
        <p class="mb-5">Tentukan targer survei per surveyor di bawah ini </p>

        <!-- avatar -->
        <div class="surveyor">
            @if ($profile_surveyor->avatar)
                <img src="{{ asset('storage/' . $profile_surveyor->avatar) }} " class="profile-img rounded-circle">
                @else
                <img src="/img/profile.png" class="profile-img rounded-circle">
                @endif
        </div>
        <div class="profile-status mt-3 d-flex flex-column">
            <h3>{{ ucwords($profile_surveyor->nama_lengkap) }}</h3>
            <p>{{ ucwords($profile_surveyor->role) }}</p>
        </div>
    </div>

    <!-- Form -->
    <form action="/surveyor/tambah-target" method="POST" class="bio-edit d-flex m-0 m-sm-5" autocomplete="off">
        @csrf
        <div class="bio-left col-12 col-sm-6 d-flex flex-column">
            <input type="hidden" name="id" value="{{ $profile_surveyor->id }}">
            <div class="col-md-8 mb-3 w-100">
                <label for="validationServer03" class="form-label">Kecamatan</label>
                <select class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan">
                    <option value="" selected disabled>--Pilih Kecamatan--</option>
                    @foreach ($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
                @error('kecamatan')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 w-100 d-flex flex-column flex-sm-row justify-content-between">
                <div class="target-kecamatan col-12 col-sm-5 me-5">
                    <label for="validationServer03" class="form-label">Kategori</label>
                    <select class="form-control form-control" id="validationServer03"
                        aria-label="Default select example " name="kategori">
                        <option value="6">Perminggu</option>
                    </select>
                </div>

                <div class="target-tanggal col-12 col-sm-5 ms-0 ms-sm-4">
                    <label for="validationServer03" class="form-label date-target">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        name="tanggal_mulai" value="{{ date('Y-m-d') }}">
                    @error('tanggal_mulai')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-8 mb-3 w-75 d-flex align-items-end">
                <div class="jumlah-target w-75 me-4">
                    <label for="validationServer03" class="form-label">Jumlah Target</label>
                    <input type="text" class="form-control @error('target') is-invalid @enderror"
                        id="validationServer03" name="target" value="10">
                    @error('target')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <span class="keterangan-target w-100 ">
                    <p>Gang dan Perumahan</p>
                </span>

            </div>
            <div class="tambah-akun mt-4">
                <button type="submit" class="btn btn-lg btn-primary mb-5 fs-6 w-100 border-0"
                    id="tambah-akun-surveyor">Simpan</button>
            </div>
        </div>
    </form>
    <!-- Form End -->
</div>
@endsection