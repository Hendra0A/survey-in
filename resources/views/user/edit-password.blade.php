@extends('user.main')
@section('header')
  <a href="/surveyor/pengaturan" class="nav-link"><i class="fas fa-chevron-left text-black"></i></a>
  <span class="fw-bold">Pengaturan</span>
@endsection
@section('content')
    <div class="content">
        <div class="container p-3">

            <h5 class="col-12">Edit Password</h5>
            <p class="col-12" style="font-size: .9em; color: #A5A5A5;">Edit password anda demi keamanan privasi Anda
            </p>

            <form action="/surveyor/pengaturan/edit-password" method="post" class="edit-password mt-5"
                autocomplete="off">
                @csrf
                <div class="kata-sandi col-12 mb-3 position-relative">
                    <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Password
                        lama</label>
                    <input name="kata_sandi_lama" type="password"
                        class="form-control @error('kata_sandi_lama') is-invalid @enderror pe-5" id="id_password"
                        style="border-radius: .5em;" placeholder="masukan password lama"
                        aria-describedby="validationServer03Feedback">
                    <i class="far fa-eye position-absolute p-1" id="togglePassword"></i>
                    @error('kata_sandi_lama')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="kata-sandi col-12 mb-3 position-relative">
                    <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Password
                        baru</label>
                    <input name="kata_sandi_baru" type="password"
                        class="form-control @error('kata_sandi_baru') is-invalid @enderror pe-5" id="id_password2"
                        style="border-radius: .5em;" placeholder="masukan password baru"
                        aria-describedby="validationServer03Feedback">
                    <i class="far fa-eye position-absolute p-1" id="togglePassword2"></i>
                    @error('kata_sandi_baru')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="kata-sandi col-12 mb-5 position-relative">
                    <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Konfirmasi
                        Password</label>
                    <input name="kata_sandi_baru_confirmation" type="password"
                        class="form-control @error('kata_sandi_baru_confirmation') is-invalid @enderror pe-5"
                        id="id_password3" style="border-radius: .5em;" placeholder="konfirmasi password baru"
                        aria-describedby="validationServer03Feedback">
                    <i class="far fa-eye position-absolute p-1" id="togglePassword3"></i>
                    @error('kata_sandi_baru_confirmation')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="tombol-konfirmasi col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-8"
                        style="border: none; border-radius: .5em; background: #3F4FC8;">Simpan</button>
                </div>
            </form>
            <!-- good luck have fun :) -->
        </div>
    </div>

    <!-- ========== SCRIPT =============== -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#id_password');
            
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
    </script>

    <script>
        const togglePassword2 = document.querySelector('#togglePassword2');
            const password2 = document.querySelector('#id_password2');
            
            togglePassword2.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
    </script>

    <script>
        const togglePassword3 = document.querySelector('#togglePassword3');
            const password3 = document.querySelector('#id_password3');
            
            togglePassword3.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
                password3.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
    </script>
@endsection