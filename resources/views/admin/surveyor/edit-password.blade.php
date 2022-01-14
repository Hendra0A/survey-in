@extends('admin.main')
@section('title', 'Surveyor')
@section('main-content')
<div class="content d-flex flex-column">
    <div class="surveyor-hl ms-5">
        <h1>Edit Profile Surveyor</h1>
        <p class="mb-5">Edit akun surveyor di bawah ini dengan benar</p>

        <!-- avatar -->
        <div class="surveyor">
            @if ($profile->avatar)
            <img src="{{ asset('storage/' . $profile->avatar) }} " class="profile-img rounded-circle">
            @else
            <img src="/img/profile.png" class="profile-img rounded-circle">
            @endif
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
        <input type="hidden" name="target" value="2">
        <div class="row justify-content-evenly">
            <div class="col-5">
                <input type="hidden" name="id" value="{{ $profile->id }}">
                <div class="bio-left d-flex flex-column position-relative">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                        id="password" name="password" placeholder="masukkan password" />
                    <i class="far fa-eye position-absolute p-1 mata-zaky" id="togglePassword"
                        style="top: 3.2em; right: 0; transform: scale(1.4);"></i>
                    @error('password')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-5">
                <div class="bio-right w-100 d-flex flex-column position-relative">
                    <label for="konfimasiPass" class="form-label fw-bold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control pe-5 @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" placeholder="konfirmasi password" />
                    <i class="far fa-eye position-absolute p-1 mata-zaky" id="togglePassword2"
                        style="top: 3.2em; right: 0; transform: scale(1.4);"></i>
                    @error('password_confirmation')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5 mt-5 justify-content-center d-flex">
                    <input type="submit" value="Simpan Perubahan" class="btn btn-lg btn-primary mb-5">
                </div>
            </div>
        </div>
    </form>
</div>

<!-- =========== SCRIPT ============ -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
</script>

<script>
    const togglePassword2 = document.querySelector('#togglePassword2');
        const password2 = document.querySelector('#password_confirmation');

        togglePassword2.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
</script>
@endsection