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
            <h2>(PONTIANAK BARAT)</h2>
        </center><br>

        <div class="pembagi">
            <div class="kiri">
                <p>Nama gang atau perumahan </p>
                <p>Lokasi</p>
                <p>Koordinat</p>
                <p>Dimensi Jalan Utama</p><br>
                <p>Kondisi Jalan</p>
                <p>Dimensi Saluran</p><br><br><br>
                <p>Kondisi Saluran</p>
                <p>Jenis Fasos</p>
                <p>Luas Fasos</p>
                <p>Koordinat Fasos</p>
                <p>Jumlah Rumah</p><br><br>
                <p>Jenis Rumah</p><br>
                <p>Pos Jaga</p>
                <p>Ruko di Bagian Depan</p>
                <p>No. IMB Pendahuluan</p>
                <p>Surveyor</p>
                <p>Lampiran Data</p>

                {{-- <h3>Ruko Samping Kanan</h3>
                <img class="img"
                    src="https://image.freepik.com/free-vector/open-source-concept-illustration_114360-3583.jpg" /><br><br>
                <h3>Kondisi Saluran Kanan</h3>
                <img class="img"
                    src="https://image.freepik.com/free-vector/open-source-concept-illustration_114360-3583.jpg" /> --}}
            </div>

            <div class="kanan">
                <p>: {{ $data->nama_gang }}</p>
                <p>: {{ $data->lokasi }}</p>
                <p>: {{ $data->no_gps }}</p>
                <p>
                <div class="isi">
                    <p>: Panjang = {{ $data->dimensi_jalan_panjang }}m</p>
                    <p>: Lebar = {{ $data->dimensi_jalan_lebar }}m</p>
                </div>
                </p>
                <p>: {{ $data->status_jalan }}%</p>
                <p>
                <div class="isi">
                    <p>: Panjang = {{ $data->dimensi_saluran_panjang_kanan }}m (kanan) dan
                        {{ $data->dimensi_saluran_panjang_kiri }} (Kiri)</p>
                    <p>: Lebar ={{ $data->dimensi_saluran_lebar_kanan }}m (Kanan) dan
                        {{ $data->dimensi_saluran_lebar_kiri }} (Kiri)</p>
                    <p>: Kedalaman = {{ $data->dimensi_saluran_kedalaman_kanan }}m (Kanan) dan
                        {{ $data->dimensi_saluran_kedalaman_kiri }} (Kiri)</p>
                </div>
                </p>
                <p>: {{ $data->status_saluran }}%</p>
                <p>:
                    @if ($fasos === 0)
                        Tidak ada
                    @else
                        @foreach ($fasos as $item)
                            {{ $item->jenis }},
                        @endforeach
                    @endif
                </p>
                <p>:
                    @if ($fasos === 0)
                        Tidak ada
                    @else
                        @foreach ($data->fasosTable as $item)
                            {{ $item->panjang }} x {{ $item->lebar }} = {{ $item->panjang * $item->lebar }},
                        @endforeach
                    @endif
                </p>
                <p>:
                    @if ($fasos === 0)
                        Tidak ada
                    @else
                        @foreach ($data->fasosTable as $item)
                            {{ $item->koordinat_fasos }},
                        @endforeach
                    @endif
                </p>
                <div class="isi">
                    <p>: Layak = {{ $data->jumlah_rumah_layak }} Unit</p>
                    <p>: Tidak Layak = {{ $data->jumlah_rumah_tak_layak }} Unit</p>
                    <p>: Kosong = {{ $data->jumlah_rumah_kosong }} Unit</p>
                </div>
                </p>
                <p>
                <div class="isi">
                    <p>: Developer = {{ $data->jumlah_rumah_developer }} Unit</p>
                    <p>: Swadaya = {{ $data->jumlah_rumah_swadaya }} Unit</p>
                </div>
                </p>
                <p>: {{ $data->pos_jaga }}</p>
                <p>: {{ $data->jumlah_ruko_kanan }} Unit {{ $data->lantai_ruko_kanan }} Lantai (Kanan) dan
                    {{ $data->jumlah_ruko_kiri }} Unit {{ $data->lantai_ruko_kiri }} Lantai (Kiri)</p>
                <p>: {{ $data->no_imb }}</p>
                <p>: {{ $data->user->nama_lengkap }}</p>
                <p>: </p>

                <h3>
                    @foreach ($data->jenisLampiran as $lampiran)
                        {{ $lampiran->jenis }}
                    @endforeach
                </h3>
                @foreach ($data->lampiranFoto as $foto)
                    <img class="img" src="{{ $foto->foto }}" /><br><br>
                @endforeach
            </div>
            <a class="btn-cetak" href="/data-survei/print/{{ $data->id }}">Cetak</a>
        </div>
</body>

</html>
