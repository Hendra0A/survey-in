@extends('user.main')
@section('header')
  <a href="/surveyor/beranda" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
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
            @php
             $selisih=\Carbon\Carbon::createFromTimestamp(strtotime($item->tanggal_mulai))->diff(\Carbon\Carbon::createFromTimestamp(strtotime($item->tanggal_selesai)))->days;
             $selisih= $selisih+1;
            @endphp
            <p class="mb-2">Kategori Target : 
              @if ($selisih !=6 && $selisih!=7)
                  <span class="fw-bold">{{ $selisih }} hari</span>
              @else
              <span class="fw-bold">Perminggu</span>
              @endif
              
            </p>
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