@extends('admin.main')
@section('title','Surveyor')
@section('main-content')
@include('admin.header')
<!-- Content -->
<div class="content d-flex flex-column">
    <div class="admin-hl text-center ">
        <h1>Akun Surveyor</h1>
        <p>Dibawah ini merupakan kumpulan akun <br>surveyor yang ada pada saat ini:</p>
    </div>

    <!-- Button Tambah -->
    {{-- <button class="btn-tambah shadow"></button> --}}
    <div class="btn-content text-end  me-5 mb-5 ">
        <a href="/surveyor/tambah" class="btn-tambah shadow text-decoration-none text-white ">+Tambah Akun</a>
    </div>

    <!-- Daftar AKun -->
    <div class="daftar-akun">
        <!-- Akun Surveyor 1 -->
        @foreach ($surveyors as $surveyor)
        <div class="akun-surveyor d-flex justify-content-between align-items-center flex-md-row flex-column">
            <div class="nama-akun">
                {{ $surveyor->nama_lengkap }}
            </div>
            <div class="tindakan d-flex flex-row">
                <a href="/surveyor/profile/{{ $surveyor->id }}" class="btn-aksi profil text-decoration-none">Profil</a>
                <a href="/surveyor/target/{{ $surveyor->id }}" class="btn-aksi target">Target</a>
                <button class="btn-aksi hapus btn-hapus-surveyor" data-bs-toggle="modal" data-bs-target="#hapusSurveyor"
                    value="{{ $surveyor->id }}">Hapus</button>
            </div>
        </div>
        @endforeach

    </div>
</div>
<div class="modal fade" id="hapusSurveyor" tabindex="-1" aria-labelledby="hapusSurveyor" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-body">
                <p class="p text-center mt-4">Anda yakin ingin hapus<br> Akun Surveyor <span id="nama"
                        class="fw-bolder"></span> ?</p>
            </div>
            <form action="/surveyor/hapus" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="idSurveyor">
                <div class="choose d-flex justify-content-center gap-5 mb-5">
                    <button type="button" class="btn btn-secondary btn-lg ps-4 pe-4 shadow-none border-0" id="cancel"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alert btn-lg ps-3 pe-3 shadow-none border-0 text-light"
                        id="exit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
            $(".btn-hapus-surveyor").click(function (e) {
                $('#idSurveyor').attr('value', e.target.value);
                $('#nama').text($(this).parent().siblings().text());
            });
        });
</script>
<!-- Contntet End -->
@endsection