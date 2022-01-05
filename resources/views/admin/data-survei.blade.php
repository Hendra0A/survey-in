@extends('admin.main')
@section('main-content')
    {{-- header --}}
    <div class="header d-flex pt-2 pb-4" id="prf-edit-header">
        <div class="subhead-a ps-3 d-flex align-items-center">
            <h1 class="h1 ms-5">Profile</h1>
        </div>
        <div class="subhead-b d-flex w-100 justify-content-end align-items-center">
            <button type="button" class="btn btn-primary me-4 border-0" id="prf-btn">+ Tambah Data</button>
            <p class="prf-p m-0 me-4">{{ $profile->nama_lengkap }}</p>
            <!-- avatar -->
            <!-- <div class="prf-img me-4 rounded-circle"></div> -->
            <img src="{{ $profile->avatar }}" alt="" class="prf-img rounded-circle">
            <!-- avatar end -->
            <div class="dropdown me-4">
                <a class="btn btn-secondary dropdown-toggle me-2" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="/profile">Profile Admin</a></li>
                    <li><button class="dropdown-item" id="open" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Keluar</button></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- end headerr --}}

    <div class="content d-flex flex-column" id="dasur-content">
        <div class="pilih w-100 d-flex flex-column container-fluid">
            <h1 class="dasur-content w-100 text-center mt-4">
                Pencarian Hasil Survei
            </h1>
            <p class="dasur-content w-100 text-center mb-4">
                Temukan hasil Survei Gang dan Perumahan di Kecamatan Pontianak Barat
            </p>
            <form action="" method="POST">
                @csrf
                <div class="row justify-content-center my-3">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="kabupaten">Kabupaten/Kota</label>
                            <select class="form-select" id="kabupaten" name="kabupaten">
                                <option selected>Pilih kota/kabupaten</option>
                                @foreach ($kabupaten as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == 13 ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="kecamatan">Kecamatan</label>
                            <select class="form-select" id="kecamatan" name="kecamatan">
                                <option value="" selected> Pilih kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="select-sub d-flex flex-wrap gap-2 mb-5 justify-content-center" id="dasur-select">

                <div class="group w-100 ps-5 pe-5 gap-3 d-flex justify-content-center" role="group"
                    aria-label="Basic example" id="dasur-group">
                    <button type="button" class="btn btn-primary p-2 shadow-none active btn-select"
                        aria-pressed="true">Pontianak Barat</button>
                    <button type="button" class="btn btn-primary p-2 shadow-none btn-select">Pontianak Kota</button>
                    <button type="button" class="btn btn-primary p-2 shadow-none btn-select">Pontianak Selatan</button>
                </div>

                <div class="group w-100 ps-5 pe-5 gap-3 d-flex justify-content-center" role="group"
                    aria-label="Basic example" id="dasur-group-dua">
                    <button type="button" class="btn btn-primary p-2 shadow-none btn-select">Pontianak Tenggara</button>
                    <button type="button" class="btn btn-primary p-2 shadow-none btn-select">Pontianak Timur</button>
                    <button type="button" class="btn btn-primary p-2 shadow-none btn-select">Pontianak Utara</button>
                </div>
            </div> --}}
        </div>

        <div class="download d-flex justify-content-between ps-5 pe-5 mb-3">
            <button type="button" class="btn btn-outline-primary download shadow-none" id="resume">Download Resume</button>
            <form action="" method="post">
                <div class="pencarian d-flex align-items-center">
                    <div class="pencarian-input me-3">
                        <input type="text" class="form-control pencarian shadow-none" id="search"
                            placeholder="cari gang dan perumahan disni..." name="search">
                    </div>
                    <button type="submit" class="btn btn-primary shadow-none" id="btn-pencarian">Search</button>
                </div>
            </form>
        </div>

        <div class="form-dasur ps-4 pe-4 mb-4 mt-4">
            <table class="table table-hover table-responsive col-lg-12" id="dasur-table" style="width: 100%;">    
            <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">Nama Gang dan Perumahan</th>
                        <th scope="col" style="width: 17%;">Lokasi</th>
                        <th scope="col" style="width: 18%;">Koordinat</th>
                        <th scope="col" style="width: 20%;">Surveyor</th>
                        <th scope="col" style="width: 25%;"></th>
                    </tr>
                </thead>
                <tbody id="data" class="data">
                </tbody>
            </table>
        </div>
        </form>

        <script src="/js/data-survei.js"></script>

    @endsection
