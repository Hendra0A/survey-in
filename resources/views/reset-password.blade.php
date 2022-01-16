<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lupa-pw-kolom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    <link rel="stylesheet" href="/css/custom-view.css">
</head>

<body>

    <div class="container-fluid d-flex flex-column ps-0 pe-0 m-0" style="background: #F3F8FF;">

        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-centers p-2">
            <div class="logo d-flex align-items-center ms-3">
                <!-- Header Icon -->
                <!-- <img src="img/logo.png" alt="" style="width: 3em;">
                <p class=" m-0 ms-1 fw-bold" style="color: #F8B94A;">Survei</p> -->
                <!-- jika ingin pakai yg icon lepas comment bagian dalam ini -->

                <!-- Header Judul -->
                <a href="/" class="nav-link"><i class="fas fa-chevron-left text-black"></i></a>
                <!-- jika ingin pakai yg judul lepas comment bagian dalam ini -->
            </div>

            <div class="dropdown me-1">
                <button class="btn btn-secondary shadow-none border-0" style="background: #F3F8FF;" type="button"
                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-black"></i>
                </button>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenu2">
                    <li><a class="dropdown-item text-decoration-none text-black">Pengaturan</a></li>
                    <li><a class="dropdown-item text-decoration-none text-black">Tentang</a></li>
                    <li><a class="dropdown-item text-decoration-none text-black">Keluar</a></li>
                </ul>
            </div>
        </div>
        <!-- Header Section -->

        <!-- Content Section -->
        <div class="content">
            <div class="container p-3">

                <h5 class="col-12">Reset Password</h5>
                <p class="col-12" style="font-size: .9em; color: #A5A5A5;">Reset password anda dengan password yang
                    mudah di ingat</p>

                <form action="/reset-password" method="post" id="form-password"
                    class="edit-password mt-5 col-12 d-flex flex-wrap justify-content-around" autocomplete="off">
                    @csrf

                    <div class="kata-sandi col-12 col-sm-5 mb-3 position-relative">
                        <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror pe-5"
                            id="id_password" style="border-radius: .5em; border: 1px solid #3F4FC8;"
                            placeholder="masukan email" aria-describedby="validationServer03Feedback">
                        <i class="far fa-eye position-absolute p-1" id="togglePassword"></i>
                        @error('email')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="kata-sandi col-12 col-sm-5 mb-3 position-relative">
                        <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Password
                            Baru</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror pe-5" id="id_password"
                            style="border-radius: .5em; border: 1px solid #3F4FC8" placeholder="masukan password baru"
                            aria-describedby="validationServer03Feedback">
                        <i class="far fa-eye position-absolute p-1" id="togglePassword"></i>
                        @error('password')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="kata-sandi col-12 col-sm-5 mb-3 position-relative">
                        <label for="validationServer03" class="form-label fs-6" style="font-weight: 500;">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror pe-5"
                            id="id_password2" style="border-radius: .5em; border: 1px solid #3F4FC8"
                            placeholder="konfirmasi password" aria-describedby="validationServer03Feedback">
                        <i class="far fa-eye position-absolute p-1" id="togglePassword2"></i>
                        @error('password_confirmation')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                </form>
                <div class="tombol-konfirmasi col-12 d-flex justify-content-center">
                    <button type="button" class="btn btn-primary col-8 col-sm-5"
                        style="border: none; border-radius: .5em; background: #3F4FC8;" data-bs-toggle="modal"
                        data-bs-target="#modal-konfirmasi">Simpan</button>
                </div>
                <!-- good luck have fun :) -->
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="modal-keluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            style="margin-top: 12em;">
            <div class="modal-dialog">
                <div class="modal-content border-0 p-4 ps-0 pe-0" style="border-radius: .5em;">
                    <p class="text-center">Anda yakin ingin<br>keluar dari aplikasi ini?</p>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal"
                            style="border-radius: .5em;">Batal</button>
                        <button type="button" class="btn btn-danger m-2" style="border-radius: .5em;">Keluar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal 2 -->
        <div class="modal fade" id="modal-konfirmasi" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="margin-top: 12em;">
            <div class="modal-dialog">
                <div class="modal-content border-0 p-4 ps-0 pe-0" style="border-radius: .5em;">
                    <p class="text-center">Anda yakin ingin<br>melakukan perubahan?</p>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal"
                            style="border-radius: .5em;">Batal</button>
                        <button type="submit" form="form-password" class="btn btn-primary m-2"
                            style="border-radius: .5em;">Simpan</button>
                    </div>
                </div>
            </div>
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
</body>

</html>