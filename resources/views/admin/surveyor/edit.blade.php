@extends('admin.main')
@section('title', 'Surveyor')
@section('main-content')
    <div class="content d-flex flex-column">
        <div class="surveyor-hl ms-5">
            <h1>Edit Profile Surveyor</h1>
            <p class="mb-5">Edit akun surveyor di bawah ini dengan benar</p>

            <!-- avatar -->
            <div class="surveyor">
                <img src="{{ $profile->avatar }}" alt="" class="profile-img rounded-circle" />
            </div>
            <div class="profile-status mt-3 d-flex flex-column">
                <h3>{{ $profile->nama_lengkap }}</h3>
                <p>{{ ucwords($profile->role) }}</p>
            </div>
        </div>
        <!-- Form Edit -->
        <form action="/surveyor/update" method="post">
            @csrf
            @method('put')
            <div class="row justify-content-evenly">
                <div class="col-5">
                    <input type="hidden" name="id" value="{{ $profile->id }}">
                    <div class="bio-left d-flex flex-column">
                        <label for="password" class="form-label fw-bold">Password :</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                </div>
                <div class="col-5">
                    <div class="bio-right w-100 d-flex flex-column">
                        <label for="konfimasiPass" class="form-label fw-bold">Konfirmasi Password :</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" required />
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5 mt-5">
                        <input type="submit" value="Simpan Perubahan" class="btn btn-lg btn-primary mb-5">
                    </div>
                </div>
        </form>
    </div>
@endsection
