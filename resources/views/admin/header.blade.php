<div class="header w-100 row align-items-center justify-content-between py-3" id="prf-edit-header">
    <div class="subhead-a align-items-center col-4">
        <h1 class="h1 ms-5 d-none d-sm-block">@yield('title')</h1>
    </div>
    <div class="subhead-b d-flex justify-content-end align-items-center col-8">
        <p class="prf-p m-0 me-4">{{ auth()->user()->nama_lengkap }}</p>
        <!-- avatar -->
        <!-- <div class="prf-img me-4 rounded-circle"></div> -->
        @if (auth()->user()->avatar)
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="prf-img rounded-circle">
        @else
        <img src="/img/profile.png" class="prf-img rounded-circle">
        @endif
        <!-- avatar end -->
        <div class="dropdown me-4">
            <a class="btn btn-secondary dropdown-toggle me-2" href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/profile">Profile Admin</a></li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                            Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
