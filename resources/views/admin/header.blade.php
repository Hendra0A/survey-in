<div class="header d-flex pb-3" id="prf-edit-header">
    <div class="subhead-a ps-3 d-flex align-items-center">
        <h1 class="h1 ms-sm-5 ps-0 ms-0">{{ ucwords($active) }}</h1>
    </div>
    <div class="subhead-b d-flex w-100 justify-content-end align-items-center">
        <p class="prf-p m-0 me-4 d-none d-md-block">{{ $profile->nama_lengkap }}</p>

        <!-- avatar -->
        <!-- <div class="prf-img me-4 rounded-circle"></div> -->
        <img src="{{ $profile->avatar }}" alt="avatar" class="prf-img rounded-circle">
        <!-- avatar end -->
        <div class="dropdown me-4">
            <a class="btn btn-secondary dropdown-toggle me-2" href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/profile">Profile Admin</a></li>
                <li><button class="dropdown-item" id="open" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Keluar</button></li>
            </ul>
        </div>
    </div>
</div>
