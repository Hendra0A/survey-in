@extends('user.main')
@section('content')
<div class="content">
    <div class="container">
      <h1 class="text-center my-5">Data Survey</h1>
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <span class="nav-item nav-link active page" data-id="0" data-method="all" aria-selected="true" >Seluruh Data</span>
          <span class="nav-item nav-link page" data-method="single" data-id="{{ auth()->user()->id }}" aria-selected="false">Survey Saya</span>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <p class="my-3">Kecamatan :</p>
          <div class="input-group mb-3">
            <select id="kecamatan" class="form-select form-select-sm m-auto shadow-none border-primary mt-1" style="width: 92%;" aria-label=".form-select-sm example">
              <option value="" selected>Pilih Kecamatan</option>   
               @foreach ($data as $kecamatan)    
                    <option value="{{ $kecamatan->id}}">{{ $kecamatan->nama }}</option>
                @endforeach
            </select>
          </div>
          <div class="input-group mb-3 position-relative">
            <input type="search" id="search" class="form-control" placeholder="Cari nama gang dan perumahan.." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
            <i class="fas fa-search position-absolute text-secondary end-0 me-2" style="top: 30%; right:50px;"></i>
          </div>
          <div class="list-data mb-5">
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <script src="/js/data-survei-user.js"></script>
@include('user.navigation')
@endsection