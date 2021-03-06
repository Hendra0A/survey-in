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
            <table align="center" cellspacing='0'>
                <tr valign='top'>
                    <td>Nama Gang atau Perumahan</td>
                    <td>:</td>
                    <td>{{ $data->nama_gang }}</td>
                </tr>
                <tr valign='top'>
                    <td>Lokasi</td>
                    <td> : </td>
                    <td>{{ $data->lokasi }}</td>
                </tr>
                <tr valign='top'>
                    <td>Koordinat</td>
                    <td>:</td>
                    <td>Depan = {{ $data->no_gps_depan }} <br>
                        Belakang = {{ $data->no_gps_belakang }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Dimensi Jalan Utama</td>
                    <td>:</td>
                    <td>
                        Panjang = {{ $data->dimensi_jalan_panjang }}m <br>
                        Lebar = {{ $data->dimensi_jalan_lebar }}m
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Kondisi Jalan</td>
                    <td>:</td>
                    <td>
                        @if ($data->konstruksiJalan==null)
                            Tidak ada
                        @else
                        {{ $data->konstruksiJalan->jenis }} Kondisi {{ $data->status_jalan }}%
                        {{ $data->status_jalan >= 50 ? '(baik)' : '(buruk)' }}
                        @endif
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Dimensi Saluran</td>
                    <td>:</td>
                    <td>
                        Panjang =
                        {{ $data->dimensi_saluran_panjang_kanan != 0 ? $data->dimensi_saluran_panjang_kanan . ' m' : 'tidak ada' }}
                        (kanan) dan
                        {{ $data->dimensi_saluran_panjang_kiri != 0 ? $data->dimensi_saluran_panjang_kiri . ' m' : 'tidak ada' }}
                        (kiri)<br>
                        Lebar =
                        {{ $data->dimensi_saluran_lebar_kanan != 0 ? $data->dimensi_saluran_lebar_kanan . ' m' : 'tidak ada' }}
                        (kanan) dan
                        {{ $data->dimensi_saluran_lebar_kiri != 0 ? $data->dimensi_saluran_lebar_kiri . ' m' : 'tidak ada' }}
                        (kiri)<br>
                        Kedalaman =
                        {{ $data->dimensi_saluran_kedalaman_kanan != 0 ? $data->dimensi_saluran_kedalaman_kanan . ' m' : 'tidak ada' }}
                        (kanan) dan
                        {{ $data->dimensi_saluran_kedalaman_kiri != 0 ? $data->dimensi_saluran_kedalaman_kiri . ' m' : 'tidak ada' }}
                        (kiri)<br>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Kondisi Saluran</td>
                    <td>:</td>
                    <td>
                        @if ($data->konstruksiSaluran==null)
                            Tidak Ada
                        @else
                            {{ $data->konstruksiSaluran->jenis }} Kondisi {{ $data->status_saluran }}%
                            {{ $data->status_saluran >= 50 ? '(baik)' : '(buruk)' }}
                        @endif
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Fasos</td>
                    <td>:</td>
                    <td>
                        @if (count($data->fasosTable) == 0)
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
                                        <td>{{ $item->panjang }} m</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 10px"></td>
                                        <td>Lebar</td>
                                        <td>=</td>
                                        <td>{{ $item->lebar }} m</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 10px"></td>
                                        <td>Luas</td>
                                        <td>=</td>
                                        <td>{{ $item->lebar * $data->fasosTable[$loop->index]->panjang }} m</td>
                                    </tr>
                                </table>
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Jumlah Rumah</td>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>Layak </td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_layak }} Unit</td>
                            </tr>
                            <tr>
                                <td>Tidak Layak</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_tak_layak }} Unit</td>
                            </tr>
                            <tr>
                                <td>Kosong</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_kosong }} Unit</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Jenis Rumah</td>
                    <td> : </td>
                    <td>
                        <table>
                            <tr>
                                <td>Developer</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_developer }} Unit</td>
                            </tr>
                            <tr>
                                <td>Swadaya</td>
                                <td>=</td>
                                <td>{{ $data->jumlah_rumah_swadaya }} Unit</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Pos Jaga</td>
                    <td>:</td>
                    <td>
                        {{ $data->pos_jaga == 1 ? 'Ada' : 'Tidak Ada' }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Ruko di Bagian Depan</td>
                    <td>:</td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    Kanan =
                                    @if ($data->jumlah_ruko_kanan == 0)
                                        tidak ada
                                    @else
                                        {{ $data->jumlah_ruko_kanan }} unit {{ $data->lantai_ruko_kanan }} lantai
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Kiri =
                                    @if ($data->jumlah_ruko_kiri == 0)
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
                    <td>:</td>
                    <td>
                        {{ $data->no_imb != 0 ? $data->no_imb : '-' }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Catatan</td>
                    <td>:</td>
                    <td style="max-width: 30px">
                        {{ $data->catatan }}
                    </td>
                </tr>
                <tr valign='top'>
                    <td>Lampiran Data</td>
                    <td>:</td>
                    <td>
                        {{ count($data->lampiranFoto) == 0 && count($data->fasosTable) == 0 ? '-' : '' }}
                    </td>
                </tr>
            </table>
            <table width='100%' align="center">
                {{-- @dd($data->lampiranFoto) --}}
                @foreach ($data->fasosTable as $item)
                    @if ($loop->iteration % 2 == 1)
                        <tr>
                    @endif
                    <td align="center" style="padding: 10px">
                        <h3 style="text-align: center">{{ $item->jenisFasos->jenis }}</h3>
                        <img src="{{ asset('storage/' . $item->foto) }}" width="300px" height="200px">
                    </td>
                    @if ($loop->iteration % 2 == 0 || $loop->iteration == count($data->fasosTable) + 1)
                        </tr>
                    @endif
                @endforeach
            </table>
            <table align='center' width="100%">
                {{-- @dd($data->lampiranFoto) --}}
                @foreach ($data->lampiranFoto as $item)
                    @if ($loop->iteration % 2 == 1 || $loop->iteration == count($data->lampiranFoto) + 1)
                        <tr>
                    @endif
                    <td align="center" style="padding: 10px">
                        <h3 style="text-align: center">{{ $item->jenisLampiran->jenis }}</h3>
                        <img src="{{ asset('storage/' . $item->foto) }}" width="300px" height="200px">
                    </td>
                    @if ($loop->iteration % 2 == 0 || $loop->iteration == count($data->lampiranFoto) + 1)
                        </tr>
                    @endif
                @endforeach
            </table>
        </center>
    </div>
</body>

</html>
