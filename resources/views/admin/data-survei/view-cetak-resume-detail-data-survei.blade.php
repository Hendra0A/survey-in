<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/fontawesome5/css/all.css">
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    {{-- <style>
        .data {
            width: 210mm;
            margin: auto;
            min-height: 100vh;
            background-color: whitesmoke;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding-bottom: 100px
        }

        body {
            background-color: gray
        }

        .btn-download {
            position: fixed;
            top: 2%;
            right: 2%;
            background: blueviolet;
            padding: 10px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .btn-back {
            position: fixed;
            top: 2%;
            left: 3%;
            background: rgb(137, 43, 226);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            color: white
        }

        .btn-back i {
            color: white;
            text-align: center
        }

        .btn-download a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        table {
            table-layout: fixed
        }

    </style> --}}

</head>


<body>
    <div class="data">
        {{-- <center><br>
            <h2 class="hh">DATA PRASARANA UTILITAS GANG DAN PERUMAHAN </h2>
            <h2>({{ $data->kecamatan->nama }})</h2>
        </center><br> --}}
        <table border="1" cellspacing=0 cellpadding=5 id="nilai">
            <thead>
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
                        <td>{{ $data->jumlah_rumah_tak_layak }}</td>
                        <td>{{ $data->jumlah_rumah_kosong }}</td>
                        <td>{{ $data->dimensi_jalan_panjang }}</td>
                        <td>{{ $data->dimensi_jalan_lebar }}</td>
                        <td>{{ $data->status_jalan ? $data->status_jalan : '' }}%</td>
                        <td>{{ 100 - $data->status_jalan }}%</td>
                        <td>{{ $data->dimensi_saluran_panjang_kanan ? $data->dimensi_saluran_panjang_kanan : '' }}
                        </td>
                        <td>{{ $data->dimensi_saluran_panjang_kiri ? $data->dimensi_saluran_panjang_kiri : '' }}</td>
                        <td>{{ $data->dimensi_saluran_lebar_kanan ? $data->dimensi_saluran_lebar_kanan : '' }}</td>
                        <td>{{ $data->dimensi_saluran_lebar_kiri ? $data->dimensi_saluran_lebar_kiri : '' }}</td>
                        <td>{{ $data->dimensi_saluran_kedalaman_kanan ? $data->dimensi_saluran_kedalaman_kanan : '' }}
                        </td>
                        <td>{{ $data->dimensi_saluran_kedalaman_kiri ? $data->dimensi_saluran_kedalaman_kiri : '' }}
                        </td>
                        <td>{{ $data->status_saluran ? $data->status_saluran : '' }}%</td>
                        <td>{{ 100 - $data->status_saluran }}%</td>
                        <td>{{ $data->jumlah_ruko_kanan ? $data->jumlah_ruko_kanan : '' }}</td>
                        <td>{{ $data->lantai_ruko_kanan ? $data->lantai_ruko_kanan : '' }}</td>
                        <td>{{ $data->jumlah_ruko_kiri ? $data->jumlah_ruko_kiri : '' }}</td>
                        <td>{{ $data->lantai_ruko_kiri ? $data->lantai_ruko_kiri : '' }}</td>
                        <td>{{ $data->pos_jaga ? $data->pos_jaga : '' }}</td>
                        <td>{{ $data->catatan ? $data->catatan : '' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Jumlah</td>
                    <td>{{ $sumDeveloper }}</td>
                    <td>{{ $sumSwadaya }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>
