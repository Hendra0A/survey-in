<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
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
    <script src="/js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container-fluid d-flex flex-column ps-0 pe-0 m-0" style="background: #F3F8FF;">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-centers p-2">
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
                    <i class="fas fa-ellipsis-v text-black"></i>
                </button>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenu2">
                    <li><a href="/surveyor/pengaturan"
                            class="dropdown-item text-decoration-none {{ $active == 'pengaturan' ? 'text-primary' : '' }}">Pengaturan</a>
                    </li>
                    <li><a
                            class="dropdown-item text-decoration-none {{ $active == 'tentang' ? 'text-primary' : '' }}">Tentang</a>
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <input type="submit" value="Keluar" class="dropdown-item text-decoration-none text-black">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')


    </div>

</body>

</html>
