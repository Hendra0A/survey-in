@extends('user.main')
@section('header')
  <a href="/surveyor/data-survei" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
  <span class="fw-bold">Pengaturan</span>
@endsection
@section('content')
<div class="content">
    <div class="container">
        {{-- @dd($data); --}}
      <h6 class="detail col-12 text-center mt-3 mb-4">DATA PRASARANA UTILITAS GANG DAN PERUMAHAN<br>
        ({{ $data->kecamatan->nama }})</h6>
      <div class="detail-data col-12 d-flex flex-column justify-content-center">
          <table class="detail col-12 mb-3">              
                  <tr>
                      <th>Nama gang dan perumahan</th>
                      <td>: {{ $data->nama_gang }}</td>
                  </tr>

                  <tr>
                      <th>Lokasi</th>
                      <td>: {{ $data->lokasi }}</td>
                  </tr>

                  <tr>
                      <th>Koordinat</th>
                      <td>: {{ $data->no_gps }}</td>
                  </tr>

                  <tr>
                      <th>Dimensi jalan utama</th>
                      <td>
                        : Panjang = {{ $data->dimensi_jalan_panjang }}m <br>
                        : Lebar = {{ $data->dimensi_jalan_lebar }}m
                      </td>
                  </tr>
                  
                  <tr>
                      <th>Kondisi jalan</th>
                      <td>: {{$data->konstruksiJalan->jenis}} Kondisi {{ $data->status_jalan }}% {{ ($data->status_jalan>=50)? '(baik)':'(buruk)' }}</td>
                  </tr>

                  <tr>
                      <th>Dimensi saluran</th>
                      <td>
                          : Panjang = {{ ($data->dimensi_saluran_panjang_kanan!=0)?$data->dimensi_saluran_panjang_kanan.' m' :'tidak ada' }} (kanan) dan {{ ($data->dimensi_saluran_panjang_kiri!=0)?$data->dimensi_saluran_panjang_kiri.' m' :'tidak ada'  }}  (kiri)<br>
                          : Lebar = {{ ($data->dimensi_saluran_lebar_kanan!=0)?$data->dimensi_saluran_lebar_kanan.' m' :'tidak ada' }} (kanan) dan {{ ($data->dimensi_saluran_lebar_kiri!=0)?$data->dimensi_saluran_lebar_kiri.' m' :'tidak ada'  }} (kiri)<br>
                          : Kedalaman = {{ ($data->dimensi_saluran_kedalaman_kanan!=0)?$data->dimensi_saluran_kedalaman_kanan.' m' :'tidak ada' }} (kanan) dan {{ ($data->dimensi_saluran_kedalaman_kiri!=0)?$data->dimensi_saluran_kedalaman_kiri.' m' :'tidak ada'  }} (kiri)<br>
                      </td>
                  </tr>

                  <tr>
                      <th>Kondisi saluran</th>
                      <td>: {{$data->konstruksiSaluran->jenis}} Kondisi {{ $data->status_saluran }}% {{ ($data->status_saluran>=50)? '(baik)':'(buruk)' }}</td>
                  </tr>
                        
                  <tr>
                      <th>Jenis Fasos</th>
                      <td> :
                        @if (count($data->fasosTable)==0)
                            Tidak ada
                        @else
                            @foreach ($data->fasosTable as $item)
                            <b>{{ $item->jenisFasos->jenis }} :</b>
                            <table class="layak fasos">
                                <tr>
                                    <th>:Koordinat</th>
                                    <td>{{ $item->koordinat_fasos }}</td>
                                </tr>
                                <tr>
                                    <th>:Panjang</th>
                                    <td>= {{ $item->panjang }} m</td>
                                </tr>
                                <tr>
                                    <th>: Lebar</th>
                                    <td>= {{ $item->lebar }} m</td>
                                </tr>
                                <tr>
                                    <th>: Luas</th>
                                    <td>= {{ $item->lebar * $data->fasosTable[$loop->index]->panjang }} m</td>
                                </tr>
                            </table>
                            @endforeach
                        @endif
                    </td>
                  </tr>

                  <tr>
                      <th>Jumlah rumah</th>
                      <td>
                        <table class="layak">
                            <tr>
                                <th>: Layak </th>
                                <td>= {{ $data->jumlah_rumah_layak }} Unit</td>
                            </tr>
                            <tr>
                                <th>: Tidak Layak</th>
                                <td>= {{ $data->jumlah_rumah_tak_layak }} Unit</td>
                            </tr>
                            <tr>
                                <th>: Kosong</th>
                                <td>= {{ $data->jumlah_rumah_kosong }} Unit</td>
                            </tr>
                        </table>
                      </td>
                  </tr>

                  <tr>
                      <th>Jenis rumah</th>
                      <td>: Developer = {{ $data->jumlah_rumah_developer }} Unit<br>
                          : Swadaya = { $data->jumlah_rumah_swadaya }}  Unit
                      </td>
                  </tr>

                  <tr>
                      <th>Pos jaga</th>
                      <td>: {{ ($data->pos_jaga==1)?"Ada" : "Tidak Ada" }}</td>
                  </tr>

                  <tr>
                      <th>Ruko di bagian depan</th>
                      <td>: Kanan =
                        @if ($data->jumlah_ruko_kanan==0)
                            tidak ada
                        @else
                            {{ $data->jumlah_ruko_kanan }} unit {{ $data->lantai_ruko_kanan }} lantai
                        @endif<br>
                          : kiri =   @if ($data->jumlah_ruko_kiri==0)
                          tidak ada
                        @else
                            {{ $data->jumlah_ruko_kiri }} unit {{ $data->lantai_ruko_kiri }} lantai
                        @endif                              
                      </td>
                  </tr>

                  <tr>
                      <th>No. IMB Pendahuluan</th>
                      <td>: {{ ($data->no_imb!=0 )? $data->no_imb : '-' }}</td>
                  </tr>

                  <tr>
                      <th>Surveyor</th>
                      <td>: <b>{{ $data->user->nama_lengkap }}</b></td>
                  </tr>

                  <tr>
                      <th>Lampiran data</th>
                      <td>
                        {{ (count($data->lampiranFoto) == 0 && count($data->fasosTable)==0)? ': -':':'  }}
                      </td>
                  </tr>
          </table>
          <table width='100%' align="center">
            {{-- @dd($data->lampiranFoto) --}}
            @foreach ($data->fasosTable as $item)
                @if ( ($loop->iteration % 2== 1))
                <tr>
                @endif
                    <td align="center" style="padding: 10px">
                        <h3 style="text-align: center">{{$item->jenisFasos->jenis}}</h3>
                        <img src="{{$item->foto}}" width="300px" height="200px">
                    </td>
                @if ( ($loop->iteration % 2 == 0) || ($loop->iteration == count($data->fasosTable)+1))
                </tr>
                @endif
            @endforeach
        </table>
        <table width='100%' align="center">
            {{-- @dd($data->lampiranFoto) --}}
            @foreach ($data->lampiranFoto as $item)
                @if ( ($loop->iteration % 2== 1))
                <tr>
                @endif
                    <td align="center" style="padding: 10px">
                        <h3 style="text-align: center">{{$item->jenisLampiran->jenis}}</h3>
                        <img src="{{$item->foto}}" width="300px" height="200px">
                    </td>
                @if ( ($loop->iteration % 2 == 0) || ($loop->iteration == count($data->lampiranFoto)+1))
                </tr>
                @endif
            @endforeach
        </table>

          <div class="tombol-detail col-12 d-flex justify-content-center">
              @if (auth()->user()->id == $data->user->id)
                <a href="" class="text-decoration-none btn btn-warning m-2 text-white" style="border-radius: .5em;"><i class="far fa-edit pe-2"></i>Edit</a>
              @endif
              <a href="/data-survei/print/{{ $data->id }}" class="text-decoration-none btn btn-primary m-2 text-white border-0" style="background: #3F4FC8; border-radius: .5em;"><i class="fas fa-download pe-2"></i>Download</a>
              
          </div>
      </div>
    </div>
  </div>
@endsection