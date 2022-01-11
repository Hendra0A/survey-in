<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Excel</title>

</head>


<body>
    <table border="1" cellspacing=0 cellpadding=5>
        <thead>
            <tr>
                <td colspan="{{ 26 + count($fasos) }}">RESUME PENDATAAN PERUMAHAN DAN GANG DI KOTA
                    {{ strtoupper($datas[0]->kecamatan->kabupaten->nama) }}
                    KECAMATAN {{ strtoupper($datas[0]->kecamatan->nama) }}
                </td>
            </tr>
            <tr>
                <td colspan="{{ 26 + count($fasos) }}">
                </td>
            </tr>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Nama Perumahan dan Gang</th>
                <th rowspan="3">Lokasi Perumahan</th>
                <th colspan="2">Jenis Rumah</th>
                <th colspan="{{ count($fasos) }}">Jumlah Fasos</th>
                <th colspan="3">Jumlah Rumah</th>
                <th rowspan="3">Panjang Jalan Perumahan (m)</th>
                <th rowspan="3">Lebar Jalan Perumahan (m)</th>
                <th colspan="2">Kondisi Jalan</th>
                <th colspan="2">Panjang Saluran</th>
                <th colspan="2">Lebar Saluran</th>
                <th colspan="2">Kedalaman</th>
                <th colspan="2">Kondisi Saluran</th>
                <th colspan="4">Ruko Bagian Depan</th>
                <th rowspan="3">Pos Jaga</th>
                <th rowspan="3">Keterangan</th>
            </tr>
            <tr>
                <th rowspan="2">Developer</th>
                <th rowspan="2">Swadaya</th>
                @foreach ($fasos as $item)
                    <th rowspan="2">{{ $item->jenis }}</th>
                @endforeach
                <th rowspan="2">Layak</th>
                <th rowspan="2">Tak Layak</th>
                <th rowspan="2">Kosong</th>
                <th rowspan="2">Baik</th>
                <th rowspan="2">Tidak Baik</th>
                <th rowspan="2">Kanan (m)</th>
                <th rowspan="2">Kiri (m)</th>
                <th rowspan="2">Kanan (m)</th>
                <th rowspan="2">Kiri(m)</th>
                <th rowspan="2">Kanan (m)</th>
                <th rowspan="2">Kiri(m)</th>
                <th rowspan="2">Baik</th>
                <th rowspan="2">Tidak Baik</th>
                <th colspan="2">Kanan</th>
                <th colspan="2">Kiri</th>
            </tr>
            <tr>
                <th>Unit</th>
                <th>Lantai</th>
                <th>Unit</th>
                <th>Lantai</th>
            </tr>
        </thead>
        <tbody>
            @php
                $iteration = 1;
                $sumDeveloper = 0;
                $sumSwadaya = 0;
                $sumFasos = 0;
                $sumLayak = 0;
                $sumTakLayak = 0;
                $sumKosong = 0;
                $sumPanjang = 0;
                $sumLebar = 0;
                $sumJalanBaik = 0;
                $sumJalanTidakBaik = 0;
                $sumSaluranPanjangKanan = 0;
                $sumSaluranPanjangKiri = 0;
                $sumSaluranLebarKanan = 0;
                $sumSaluranLebarKiri = 0;
                $sumSaluranKedalamanKanan = 0;
                $sumSaluranKedalamanKiri = 0;
                $sumSaluranBaik = 0;
                $sumSaluranTidakBaik = 0;
                $sumJumlahRukoKanan = 0;
                $sumLantaiRukoKanan = 0;
                $sumJumlahRukoKiri = 0;
                $sumLantaiRukoKiri = 0;
                $sumPos = 0;
            @endphp
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $iteration++ }}</td>
                    <td>{{ $data->nama_gang }}</td>
                    <td>{{ $data->lokasi }}</td>
                    <td>{{ $data->jumlah_rumah_developer }}</td>
                    @php
                        $sumDeveloper += $data->jumlah_rumah_developer;
                    @endphp
                    <td>{{ $data->jumlah_rumah_swadaya }}</td>
                    @php
                        $sumSwadaya += $data->jumlah_rumah_swadaya;
                    @endphp
                    @foreach ($fasos as $item)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($data->fasosTable as $fasostabel)
                            @if ($item->id == $fasostabel->jenis_fasos_id)
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach
                        @for ($i; $i < $i; $i++)
                        @endfor
                        <td>{{ $i ? $i : '' }}</td>
                    @endforeach

                    <td>{{ $data->jumlah_rumah_layak }}</td>
                    @php
                        $sumLayak += $data->jumlah_rumah_layak;
                    @endphp
                    <td>{{ $data->jumlah_rumah_tak_layak }}</td>
                    @php
                        $sumTakLayak += $data->jumlah_rumah_tak_layak;
                    @endphp
                    <td>{{ $data->jumlah_rumah_kosong }}</td>
                    @php
                        $sumKosong += $data->jumlah_rumah_kosong;
                    @endphp
                    <td>{{ $data->dimensi_jalan_panjang }}</td>
                    @php
                        $sumPanjang += $data->dimensi_jalan_panjang;
                    @endphp
                    <td>{{ $data->dimensi_jalan_lebar }}</td>
                    @php
                        $sumLebar += $data->dimensi_jalan_lebar;
                    @endphp
                    <td>{{ $data->status_jalan ? $data->status_jalan : '' }}%</td>
                    @php
                        $sumJalanBaik += $data->status_jalan;
                    @endphp
                    <td>{{ 100 - $data->status_jalan }}%</td>
                    @php
                        $sumJalanTidakBaik += 100 - $data->status_jalan;
                    @endphp
                    <td>{{ $data->dimensi_saluran_panjang_kanan ? $data->dimensi_saluran_panjang_kanan : '' }}
                    </td>
                    @php
                        $sumSaluranPanjangKanan += $data->dimensi_saluran_panjang_kanan;
                    @endphp
                    <td>{{ $data->dimensi_saluran_panjang_kiri ? $data->dimensi_saluran_panjang_kiri : '' }}</td>
                    @php
                        $sumSaluranPanjangKiri += $data->dimensi_saluran_panjang_kiri;
                    @endphp
                    <td>{{ $data->dimensi_saluran_lebar_kanan ? $data->dimensi_saluran_lebar_kanan : '' }}</td>
                    @php
                        $sumSaluranLebarKanan += $data->dimensi_saluran_lebar_kanan;
                    @endphp
                    <td>{{ $data->dimensi_saluran_lebar_kiri ? $data->dimensi_saluran_lebar_kiri : '' }}</td>
                    @php
                        $sumSaluranLebarKiri += $data->dimensi_saluran_lebar_kiri;
                    @endphp
                    <td>{{ $data->dimensi_saluran_kedalaman_kanan ? $data->dimensi_saluran_kedalaman_kanan : '' }}
                    </td>
                    @php
                        $sumSaluranKedalamanKanan += $data->dimensi_saluran_kedalaman_kanan;
                    @endphp
                    <td>{{ $data->dimensi_saluran_kedalaman_kiri ? $data->dimensi_saluran_kedalaman_kiri : '' }}
                    </td>
                    @php
                        $sumSaluranKedalamanKiri += $data->dimensi_saluran_kedalaman_kiri;
                    @endphp
                    <td>{{ $data->status_saluran ? $data->status_saluran : '' }}%</td>
                    @php
                        $sumSaluranBaik += $data->status_saluran;
                    @endphp
                    <td>{{ 100 - $data->status_saluran }}%</td>
                    @php
                        $sumSaluranTidakBaik += 100 - $data->status_saluran;
                    @endphp
                    <td>{{ $data->jumlah_ruko_kanan ? $data->jumlah_ruko_kanan : '' }}</td>
                    @php
                        $sumJumlahRukoKanan += $data->jumlah_ruko_kanan;
                    @endphp
                    <td>{{ $data->lantai_ruko_kanan ? $data->lantai_ruko_kanan : '' }}</td>
                    @php
                        $sumLantaiRukoKanan += $data->lantai_ruko_kanan;
                    @endphp
                    <td>{{ $data->jumlah_ruko_kiri ? $data->jumlah_ruko_kiri : '' }}</td>
                    @php
                        $sumJumlahRukoKiri += $data->jumlah_ruko_kiri;
                    @endphp
                    <td>{{ $data->lantai_ruko_kiri ? $data->lantai_ruko_kiri : '' }}</td>
                    @php
                        $sumLantaiRukoKiri += $data->lantai_ruko_kiri;
                    @endphp
                    <td>{{ $data->pos_jaga ? $data->pos_jaga : '' }}</td>
                    @php
                        $sumPos += $data->pos_jaga;
                    @endphp
                    <td>{{ $data->catatan ? $data->catatan : '' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Jumlah</td>
                <td>{{ $sumDeveloper }}</td>
                <td>{{ $sumSwadaya }}</td>
                @foreach ($fasos as $item)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($datas as $data)
                        @foreach ($data->fasosTable as $fasostabel)
                            @if ($item->id == $fasostabel->jenis_fasos_id)
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <td>{{ $i }}</td>
                @endforeach
                <td>{{ $sumLayak }}</td>
                <td>{{ $sumTakLayak }}</td>
                <td>{{ $sumKosong }}</td>
                <td>{{ $sumPanjang }}</td>
                <td>{{ $sumLebar }}</td>
                <td>{{ round($sumJalanBaik / count($datas), 2) }}%</td>
                <td>{{ round($sumJalanTidakBaik / count($datas), 2) }}%</td>
                <td>{{ $sumSaluranPanjangKanan }}</td>
                <td>{{ $sumSaluranPanjangKiri }}</td>
                <td>{{ $sumSaluranLebarKanan }}</td>
                <td>{{ $sumSaluranLebarKiri }}</td>
                <td>{{ $sumSaluranKedalamanKanan }}</td>
                <td>{{ $sumSaluranKedalamanKiri }}</td>
                <td>{{ round($sumSaluranBaik / count($datas), 2) }}%</td>
                <td>{{ round($sumSaluranTidakBaik / count($datas), 2) }}%</td>
                <td>{{ $sumJumlahRukoKanan }}</td>
                <td>{{ $sumLantaiRukoKanan }}</td>
                <td>{{ $sumJumlahRukoKiri }}</td>
                <td>{{ $sumLantaiRukoKiri }}</td>
                <td>{{ $sumPos }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
