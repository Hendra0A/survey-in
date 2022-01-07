<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        .data{
            width: 210mm;
            margin: auto;
            min-height: 100vh;
            background-color: whitesmoke;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        body{
            background-color: gray
        }
        .btn-download{
            position: fixed;
            top: 2%;
            right:2%;
            background: blueviolet;
            padding: 10px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .btn-back{
            position: fixed;
            top: 2%;
            left:3%;
            background: rgb(137, 43, 226);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            color: white
        }.btn-back i{
            color: white;
            text-align: center
        }
        .btn-download a{
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        table{
            table-layout: fixed
        }
    </style>

</head>


<body>
    <div class="data" >
        <center><br>
            <h2 class="hh">DATA PRASARANA UTILITAS GANG DAN PERUMAHAN </h2>
            <h2>({{ $data->kecamatan->nama }})</h2>
        </center><br>

        <center>
            <table align="center"  cellspacing='0' cellpadding="7">
                <tr valign='top'>
                    <td>Nama Gang atau Perumahan</td>
                    <td style="padding: 0 20px">:</td>
                    <td>{{ $data->nama_gang }}</td>
                </tr>
                <tr valign='top'>
                    <td>Lokasi</td>
                    <td style="padding: 0 20px"> : </td>
                    <td>{{ $data->lokasi }}</td>
                </tr>
                <tr valign='top'>
                    <td>Koordinat</td>
                    <td style="padding: 0 20px">:</td>
                    <td>{{ $data->no_gps }}</td>
                </tr>
                <tr valign='top'>
                    <td>Dimensi Jalan Utama</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        Panjang = {{ $data->dimensi_jalan_panjang }}m <br>
                        Lebar = {{ $data->dimensi_jalan_lebar }}m
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Kondisi Jalan</td>
                    <td style="padding: 0 20px">:</td>
                    <td>{{ $data->status_jalan }}</td>
                </tr>
                <tr valign='top'>
                    <td>Dimensi Saluran</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        Panjang = {{ $data->dimensi_jalan_panjang }}m <br>
                        Lebar = {{ $data->dimensi_jalan_lebar }}m
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Kondisi Saluran</td>
                    <td style="padding: 0 20px">:</td>
                    <td>{{ $data->status_saluran }}</td>
                </tr>
                <tr valign='top'>
                    <td>Fasos</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                    @if (count($data->fasosTable)==0)
                        Tidak ada
                    @else
                        @foreach ($data->fasosTable as $item)
                        <b>{{ $item->jenisFasos->jenis }} :</b>
                        <table>
                            <tr>
                                <td style="padding: 0 10px"></td>
                                <td>Koordinat</td>
                                <td>=</td>
                                <td>{{ $item->koordinat_fasos }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0 10px"></td>
                                <td>Panjang</td>
                                <td>=</td>
                                <td>{{ $item->panjang }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0 10px"></td>
                                <td>Lebar</td>
                                <td>=</td>
                                <td>{{ $item->lebar }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 0 10px"></td>
                                <td>Luas</td>
                                <td>=</td>
                                <td>{{ $item->lebar * $data->fasosTable[$loop->index]->panjang }}</td>
                            </tr>
                        </table>
                        @endforeach
                    @endif
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Jumlah Rumah</td>
                    <td style="padding: 0 20px"> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>Layak </td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_layak }}</td>
                            </tr>
                            <tr>
                                <td>Tidak Layak</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_tak_layak }}</td>
                            </tr>
                            <tr>
                                <td>Kosong</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_kosong }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Jenis Rumah</td>
                    <td style="padding: 0 20px"> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>Developer</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_developer }} Unit {{ $data->lantai_ruko_kana }}</td>
                            </tr>
                            <tr>
                                <td>Swadaya</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_swadaya }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Pos Jaga</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        {{ ($data->pos_jaga==1)?"Ada" : "Tidak Ada" }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Ruko di Bagian Depan</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    Kanan =
                                    @if ($data->jumlah_ruko_kanan==0)
                                        tidak ada
                                    @else
                                        {{ $data->jumlah_ruko_kanan }} unit {{ $data->lantai_ruko_kanan }} lantai
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Kiri =
                                    @if ($data->jumlah_ruko_kiri==0)
                                        tidak ada
                                    @else
                                        {{ $data->jumlah_ruko_kiri }} unit {{ $data->lantai_ruko_kiri }} lantai
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>No IMB Pendahuluan</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        {{ $data->no_imb }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Catatan</td>
                    <td style="padding: 0 20px">:</td>
                    <td style="max-width: 30px">
                        {{ $data->catatan }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td><b>Nama Surveyor</b></td>
                    <td style="padding: 0 20px">:</td>
                    <td style="max-width: 30px">
                        <b>{{ $data->user->nama_lengkap }}</b>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Lampiran Data</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        
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
        </center>
    </div>
    <div class="btn-download">
        <a class="btn-cetak" href="/data-survei/print/{{ $data->id }}"><i class="fas fa-download"></i>Download</a>
    </div>
    <div class="btn-back">
        <a class="btn-cetak" href="/data-survei"><i class="fas fa-arrow-left"></i></a>
    </div>
</body>
</html>
