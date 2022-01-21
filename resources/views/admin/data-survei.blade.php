@extends('admin.main')
@section('title', 'Data Survei')
@section('main-content')
    {{-- header --}}
    @include('admin.header')
    {{-- end headerr --}}

    <div class="content d-flex flex-column" id="dasur-content">
        <div class="pilih w-100 d-flex flex-column container-fluid">
            <h1 class="dasur-content w-100 text-center mt-4">
                Pencarian Hasil Survey
            </h1>
            <p class="dasur-content w-100 text-center mb-4">
                Temukan hasil Survey Gang dan Perumahan <br> di Kecamatan <span class="text-kec">Pontianak Barat</span>
            </p>
            <form action="" method="POST">
                @csrf
                <div class="row justify-content-around my-3 col-12 d-flex flex-column flex-sm-row">
                    <div class="col-sm-5 col-12">
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
                    <div class="col-sm-5 col-12">
                        <div class="input-group mb-3">
                            <label class="input-group-text fw-bold" for="kecamatan">Kecamatan</label>
                            <select class="form-select" id="kecamatan" name="kecamatan">
                                <option value="" selected> Pilih kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>

        <div class="download d-flex justify-content-between ps-5 pe-5 mb-3">
            <a id="resume" class="btn btn-outline-primary download shadow-none">Download
                Resume</a>
        </div>
        <div class="form-dasur ps-4 pe-4 mb-4 mt-4">
            <table class="table table-hover bg-white shadow-sm table-responsive flex-column" id="dasur-table" style="width: 100%;">
                <thead>
                    <tr style="vertical-align: middle">
                        <th scope="col" style="width: 20%;">Nama Gang dan Perumahan</th>
                        <th scope="col" style="width: 21%;">Lokasi</th>
                        <th scope="col" style="width: 15%;">Koordinat</th>
                        <th scope="col" style="width: 20%;">Surveyor</th>
                        <th scope="col" style="width: 25%;">Aktivitas</th>
                    </tr>
                </thead>
                <tbody id="data" class="data">
                    <script type="module" src="/js/data-survei.js"></script>
                </tbody>
            </table>
        </div>
        </form>


        <!-- Modal 3 -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
            aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-hapus-data" method="post" action="/data-survei">
                    @csrf
                    @method('put')
                    <div class="modal-content border-0">
                        <div class="modal-body">
                            <p class="p text-center mt-4">Anda yakin ingin menghapus<br>data ini ?</p>
                            <input type="hidden" name="id" id="hapus-id">
                        </div>

                        <div class="choose d-flex justify-content-center gap-5 mb-5">
                            <button type="button" class="btn btn-secondary btn-lg ps-3 pe-3 shadow-none border-0"
                                data-bs-dismiss="modal">batal</button>
                            <button type="submit"
                                class="btn btn-danger btn-lg ps-4 pe-4 shadow-none border-0">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        {{-- Ini form --}}
        <script>
            $(window).ready(function() {
                $("#dasur-table").click(function(e) {
                    let btn = e.target;
                    if (btn.classList.contains('btn-hapus')) {
                        $('#hapus-id').attr('value', btn.value);
                    }
                })
            });
        </script>
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    @endsection
