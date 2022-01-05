<p>Nama gang atau perumahan : {{ $data->nama_gang }}</p>
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
<p>Ruko di bagian depan : </p>
<p>No. IMB Pendahuluan : {{ $data->no_imb }}</p>
<p>Surveyor : {{ $data->user->nama_lengkap }}</p>
<p>Lampiran Data : </p>

<a href="/data-survei/print/{{ $data->id }}">Print PDF</a>
