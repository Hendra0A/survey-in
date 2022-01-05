<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>

    <div class="container-fluid d-flex w-100 m-0 p-0">
        <!-- sidebar -->
        <nav class="navbar navbar-expand d-flex flex-column align-item-start p-2" id="sidebar">
            <div class="logo mt-3">
                <div class="logo-img mt-5 mb-3 d-flex m-auto"></div>
                <h2 class="logo text-center mt-2">Survei</h2>
                <p class="logo text-center ps-1 pe-1">Aplikasi Survei Gang dan Perumahan</p>
            </div>
            <ul class="navbar-nav d-flex flex-column mt-3 w-100">
                <li class="nav-item w-100">
                    <a href="/beranda" class="nav-link {{ ($active=='beranda')?'text-primary':'' }}"><i
                            class="fas fa-home"></i>Beranda</a>
                </li>
                <li class="nav-item w-100">
                    <a href="/profile" class="nav-link {{ ($active=='profile')?'text-primary':'' }}"><i
                            class="fas fa-user"></i>Profile</a>
                </li>
                <li class="nav-item w-100">
                    <a href="/surveyor" class="nav-link {{ ($active=='surveyor')?'text-primary':'' }}"><i
                            class="fas fa-poll-h"></i>Surveyor</a>
                </li>
                <li class="nav-item w-100">
                    <a href="/data-survei" class="nav-link {{ ($active=='data')?'text-primary':'' }}"><i
                            class="fas fa-download"></i>Data Survei</a>
                </li>
                <li class="nav-item w-100">
                    <a href="/pengaturan" class="nav-link {{ ($active=='pengaturan')?'text-primary':'' }}"><i
                            class="fas fa-cog"></i>Pengaturan</a>
                </li>
                <li class="nav-item w-100">
                    <a href="login.html" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="fas fa-sign-out-alt"></i>Keluar</a>
                </li>
            </ul>
        </nav>
        <!-- sidebar end -->

        <!-- main-content -->
        <section class="my-container d-flex flex-column w-100 pt-3 overflow-hidden" id="prf-page-section">
            <button class="btn my-2" id="menu-btn">xxx</button>
            <!-- Header -->
            <!-- Content -->
            @yield('main-content')
            <!-- Footer -->
            <div class="footer pt-4 d-flex justify-content-center">
                <p class="copyright pt-2 pb-2">&copy; Website Survei 2021</p>
            </div>

        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <p class="p text-center mt-4">Anda yakin ingin keluar<br>dari aplikasi ini ?</p>
                    </div>

                    <div class="choose d-flex justify-content-center gap-5 mb-5">
                        <button type="button" class="btn btn-secondary btn-lg ps-3 pe-3 shadow-none border-0"
                            id="exit"><a href="login.html">Keluar</a></button>
                        <button type="button" class="btn btn-secondary btn-lg ps-4 pe-4 shadow-none border-0"
                            id="cancel" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"
        integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous">
    </script>
</body>

</html>