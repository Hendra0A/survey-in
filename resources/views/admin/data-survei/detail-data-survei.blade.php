{{-- <p>Nama gang atau perumahan : {{ $data->nama_gang }}</p>
<p>Lokasi : {{ $data->lokasi }}</p>
<p>Koordinat : {{ $data->no_gps }}</p>
<p>Dimensi Jalan Utama : Panjang = {{ $data->dimensi_jalan_panjang }}m, <br>Lebar =
    {{ $data->dimensi_jalan_lebar }}m</p>
<p>Kondisi Jalan : {{ $data->status_jalan }}%</p>
<p>Dimensi Saluran : Panjang = {{ $data->dimensi_saluran_panjang_kanan }} (kanan) dan
    {{ $data->dimensi_saluran_panjang_kiri }} (kiri),
    <br>Lebar = {{ $data->dimensi_saluran_lebar_kanan }} (kanan) dan (kiri) {{ $data->dimensi_saluran_lebar_kiri }},
    <br> Kedalaman =
    {{ $data->dimensi_saluran_kedalaman_kanan }} (kanan) dan (kiri) {{ $data->dimensi_saluran_kedalaman_kiri }}
</p>
<p>Kondisi Saluran : {{ $data->status_saluran }}%</p>
<p>Jenis Fasos :
    @if ($fasos === 0)
        Tidak ada
    @else
        @foreach ($fasos as $item)
            {{ $item->jenis }},
        @endforeach
    @endif

</p>
<p>Luas Fasos :
    @if ($fasos === 0)
        Tidak ada
    @else
        @foreach ($data->fasosTable as $item)
            {{ $item->panjang }} x {{ $item->lebar }} = {{ $item->panjang * $item->lebar }},
        @endforeach
    @endif
</p>
<p>Koordinat Fasos :
    @if ($fasos === 0)
        Tidak ada
    @else
        @foreach ($data->fasosTable as $item)
            {{ $item->koordinat_fasos }},
        @endforeach
    @endif
</p>
<p>Jumlah Rumah : Layak = {{ $data->jumlah_rumah_layak }}, <br>Tidak Layak = {{ $data->jumlah_rumah_tak_layak }},
    <br>Kosong = {{ $data->jumlah_rumah_kosong }}
</p>
<p>Jenis Rumah : Developer = {{ $data->jumlah_rumah_developer }}, <br>Swadaya = {{ $data->jumlah_rumah_swadaya }}
</p>
<p>Pos Jaga : {{ $data->pos_jaga }}</p>
<p>Ruko di bagian depan : {{ $data->jumlah_ruko_kanan }} unit {{ $data->lantai_ruko_kanan }} Lantai (Kanan) dan
    {{ $data->jumlah_ruko_kiri }} unit {{ $data->lantai_ruko_kiri }} Lantai (Kanan)</p>
<p>No. IMB Pendahuluan : {{ $data->no_imb }}</p>
<p>Surveyor : {{ $data->user->nama_lengkap }}</p>
<p>Lampiran Data : </p>
<p>
    @foreach ($data->jenisLampiran as $lampiran)
        {{ $lampiran->jenis }}
    @endforeach
    <br>
    @foreach ($data->lampiranFoto as $foto)
        <img src="{{ $foto->foto }}" width="120px" id="img">
    @endforeach
</p>

<a href="/data-survei/print/{{ $data->id }}">Print PDF</a> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>
    <div class="data">
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
                    {{-- @dd($data) --}}
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
                                <td>{{ $data->jumlah_rumah_developer }}</td>
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
                        {{ $data->pos_jaga }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Lampiran Data</td>
                    <td style="padding: 0 20px">:</td>
                    <td>
                        
                    </td>
                </tr>
            </table>
            {{-- @dd($data->lampiranFoto); --}}
        </center>
        <div class="pembagi">
            <a class="btn-cetak" href="/data-survei/print/{{ $data->id }}">Cetak</a>
        </div>
</body>

</html>
