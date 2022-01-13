<nav class="navbar navbar-dark navbar-expand fixed-bottom pb-0" style="background: #3F4FC8;">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item position-relative">
            <i class="bi {{ ($active=='beranda')? 'bi-house-door-fill' : 'bi-house-door'}}"></i>
            <a href="/surveyor/beranda"
                class="nav-link text-white d-flex justify-content-center align-items-end">Beranda</a>
        </li>
        <li class="nav-item">
            <i class="bi {{ ($active=='data-survei')? 'bi-file-earmark-minus-fill' : 'bi-file-earmark-minus'}}"></i>
            <a href="/surveyor/data-survei"
                class="nav-link text-white d-flex justify-content-center align-items-end">Data Survei</a>
        </li>
        <li class="nav-item">
            <i class="bi {{ ($active=='tambah-data')? 'bi-file-earmark-plus-fill' : 'bi-file-earmark-plus'}}"></i>
            <a href="/surveyor/tambah-data"
                class="nav-link text-white d-flex justify-content-center align-items-end">Tambah Data</a>
        </li>
        <li class="nav-item">
            <i class="bi {{ ($active=='profile')? 'bi-person-fill' : 'bi-person'}}"></i>
            <a href="/surveyor/profile"
                class="nav-link text-white d-flex justify-content-center align-items-end">Profil</a>
        </li>
    </ul>
</nav>
