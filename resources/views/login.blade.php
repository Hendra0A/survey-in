<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    <link rel="stylesheet" href="/css/custom.css">

</head>

<body>
    <div class="container-fluid d-flex justify-content-center w-100 p-0 m-0 vh-100">
        <div class="login-form d-flex flex-column w-100 justify-content-center" id="main-login">

            <div class="d-sm-block d-md-none">
                <img src="{{ asset('/img/logo-b.png') }}" class="img-fluid d-block mx-auto">
                <p class="text-center text-warning fw-bold fs-1">Survei</p>
            </div>

            <h1 class="login mb-5 px-3 text-center">Mari kita mulai</h1>
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="/" method="post" class="login d-flex flex-column px-3 px-5">
                @csrf
                <div class="login mb-3">
                    <label for="exampleInputEmail1" class="form-label login">Email</label>
                    <input type="email" name="email" class="kolom form-control shadow-none" id="email"
                        aria-describedby="emailHelp" autofocus value="{{ old('email') }}">
                </div>
                <div class="login mb-3 mb-5">
                    <label for="exampleInputPassword1" class="form-label login">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" class="kolom form-control shadow-none pe-5" id="password">
                        <i class="far fa-eye position-absolute p-0" style="top: 1.15em; right: 0;" id="togglePassword"></i>
                    </div>
                    <div class="remember-me">
                        <a href="/forgot-password" class=" text-primary text-decoration-none float-end pt-1" style="color: gray; font-size: .9em;">Lupa password?</a> 
                        <label class="checkbox fw-normal d-flex align-items-start p-0" style="font-size: .9em">
                            <input type="checkbox" value="remember-me" id="remember_me" name="remember" class="me-2 mt-2 m-0 h-auto" style="vertical-align: top;"> Remember me
                        </label>       
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Masuk</button>
            </form>
        </div>

        <div class="hero flex-column position-relative justify-content-center" id="hero">
            <div class="logo position-absolute d-flex flex-column align-items-center">
                <img src="img/logo.png" alt="" class="logo-img text-center">
                <h4 class="logo w-75 text-center p-0 mt-2">Survei</h4>
            </div>

            <div class="desc pe-5">
                <h1 class="h1 w-100">Selamat Datang di Aplikasi Website <span>Survei</span></h1>
                <p class="sub w-100">Aplikasi ini memudahkan anda untuk menyimpan data hasil survei gang dan
                    perumahan</p>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"
        integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous">
    </script>
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
    @include('sweetalert::alert')
</body>

</html>