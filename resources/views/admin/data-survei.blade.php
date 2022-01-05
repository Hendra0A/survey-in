@extends('admin.main')
@section('title', 'Data Survei')
@section('main-content')
{{-- header --}}
@include('admin.header')
{{-- end headerr --}}

<div class="content d-flex flex-column" id="dasur-content">
    <div class="pilih w-100 d-flex flex-column container-fluid">
        <h1 class="dasur-content w-100 text-center mt-4">
            Pencarian Hasil Survei
        </h1>
        <p class="dasur-content w-100 text-center mb-4">
            Temukan hasil Survei Gang dan Perumahan di Kecamatan <span class="text-kec">Pontianak Barat</span>
        </p>
        <form action="" method="POST">
            @csrf
            <div class="row justify-content-center my-3">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text fw-bold" for="kabupaten">Kabupaten/Kota</label>
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
                        <label class="input-group-text fw-bold" for="kecamatan">Kecamatan</label>
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
        <table class="table table-hover" id="dasur-table" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col" style="width: 20%;">Nama Gang dan Perumahan</th>
                    <th scope="col" style="width: 21%;">Lokasi</th>
                    <th scope="col" style="width: 15%;">Koordinat</th>
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

    <!-- Modal 3 -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-hapus-data" method="post" action="/pengaturan/edit-data-survey/hapus">
                @csrf
                @method('put')
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <p class="p text-center mt-4">Anda yakin ingin menghapus<br>data ini ?</p>
                        <input type="hidden" name="id" id="hapus-id">
                        <input type="hidden" name="model" id="hapus-model">
                    </div>

                    <div class="choose d-flex justify-content-center gap-5 mb-5">
                        <button type="submit"
                            class="btn btn-danger btn-lg ps-4 pe-4 shadow-none border-0">Hapus</button>
                        <button type="button" class="btn btn-secondary btn-lg ps-3 pe-3 shadow-none border-0"
                            data-bs-dismiss="modal">batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".btn-table").click(function(e) {
                console.log(e)
                // $('#hapus-id').attr('value', $(e.target).val());
                // $('#hapus-model').attr('value', $(e.target).data('model'));
            })
        })
    </script>

    @endsection