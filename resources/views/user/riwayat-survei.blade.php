@extends('user.main')
@section('header')
  <a href="/user/beranda" class="nav-link"><i class="fas fa-chevron-left text-black"></i></a>
  <span class="fw-bold">Riwayat Survei</span>
@endsection
@section('content')
<div class="content">
    <div class="container">
      <div class="Riwayat Survei m-3 ">
        <!-- Riwayat Survei -->
        @foreach ($data as $item)
          <div class="card-riwayat-survei p-3 mb-3 justify-content-center rounded-3 shadow-sm bg-white">
            <p class="mb-2">{{ $item->tanggal_mulai}} - {{ $item->tanggal_selesai}}</p>
            <h4 class="mb-0">Kecamatan {{ $item->kecamatan->nama}}</h4>
            <hr>
            <p class="mb-2">Kategori Target : perminggu</p>
            <p class="mb-2">Status : {{ $item->selesai}} dari {{ $item->target}} Gang dan perumahan</p>
            <p class="mb-2">Perhitungan target : <span class="{{ ( $item->selesai - $item->target < 0)? 'text-danger':'text-success' }} fw-bold">
            @if (($item->selesai - $item->target) > 0)
                + {{$item->selesai - $item->target }} Gang dan Perumahan
            @elseif ($item->selesai - $item->target == 0)
                Survei Sukses
            @elseif(($item->selesai - $item->target) < 0)
                {{$item->selesai - $item->target }} Gang dan Perumahan
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection