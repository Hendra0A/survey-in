<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    <link rel="stylesheet" href="/css/custom-view.css">
    <script src="/js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container-fluid d-flex flex-column ps-0 pe-0 m-0 overflow-hidden" style="background: #F3F8FF;">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-centers p-2 text-dark">
            <div class="logo d-flex align-items-center ms-2">
                @hasSection('header')
                    @yield('header')
                @else
                    <img src="/img/logo-b.png" alt="" style="width: 3em;">
                    <p class=" m-0 ms-1 text-warning ">Survei</p>
                @endif
            </div>
            <div class="dropdown me-1">
                <button class="btn btn-secondary shadow-none border-0" style="background: #F3F8FF;" type="button"
                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-dark"></i>
                </button>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenu2">
                    <li><a href="/surveyor/pengaturan"
                            class="dropdown-item text-decoration-none {{ $active == 'pengaturan' ? 'text-primary' : '' }}">Pengaturan</a>
                    </li>
                    <li><a href="/surveyor/tentang"
                            class="dropdown-item text-decoration-none {{ $active == 'tentang' ? 'text-primary' : '' }}">Tentang</a>
                    </li>
                    <li>
                        <input type="submit" value="Keluar" class="dropdown-item text-decoration-none text-black"
                            data-bs-toggle="modal" data-bs-target="#modal-keluar">
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')

        {{-- modal --}}
        <div class="modal fade" id="modal-keluar" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="margin-top: 12em;">
            <div class="modal-dialog">
                <div class="modal-content border-0 p-4 ps-0 pe-0" style="border-radius: .5em;">
                    <p class="text-center">Anda yakin ingin<br>keluar dari aplikasi ini?</p>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal"
                            style="border-radius: .5em;">Batal</button>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger m-2"
                                style="border-radius: .5em;">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('sweetalert::alert')
    </div>
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.js') }}" type="module"></script>
</body>

</html>
