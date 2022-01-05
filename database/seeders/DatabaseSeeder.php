<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fasos;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\DetailSurveys;
use App\Models\JenisFasos;
use App\Models\LampiranFoto;
use App\Models\JenisLampiran;
use App\Models\DetailSurvey;
use Illuminate\Database\Seeder;
use App\Models\JenisKonstruksiJalan;
use App\Models\JenisKonstruksiSaluran;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $kabupaten = ['Bengkayang', 'Kapuas Hulu', 'Kayong Utara', 'Ketapang', 'Kubu Raya', 'Landak', 'Melawi', 'Mempawah', 'Sambas', 'Sanggau', 'Sekadau', 'Sintang', 'Pontianak', 'Singkawang'];
        $kecamatan = [
            1 => ['Bengkayang', 'Capkala', 'Jagoi Babang', 'Ledo', 'Lembah Bawang', 'Lumar', 'Menterado', 'Samalantan', 'Sanggau Ledo', 'Seluas', 'Siding', 'Sungai Beliung', 'Sungai Raya Kepulauan', 'Suti Semarang', 'Teriak', 'Tujuh Belas'],
            2 => ['Badau', 'Batang Lupar', 'Bika', 'Boyan Tanjung', 'Bunut Hilir', 'Bunut Hulu', 'Embaloh Hulu', 'Empanang', 'Hulu Gurung', 'Jongkong', 'Kalis', 'Mentebah', 'Pengkadan', 'Puring Kencana', 'Putusibau Selatan', 'Putusibau Utara', 'Seberuang', 'Selimbau', 'Semitau', 'Silat Hilir', 'Silat Hulu', 'Suhaid'],
            3 => ['Kepulauan Karimata', 'Pulau Maya', 'Seponti', 'Simpang Hilir', 'Sukadana', 'Teluk Batang'],
            4 => ['Air Upas', 'Benua Kayong', 'Delta Pawan', 'Hulu Sungai', 'Jelai Hulu', 'Kendawangan', 'Manis Mata', 'Marau', 'Matan Hilir', 'Muara Pawan', 'Nanga Tayap', 'Pemahan', 'Sandai', 'Simpang Dua', 'Singkup', 'Sungai Melayu Rayak', 'Tumbang Hulu', 'Tumbang Titi'],
            5 => [
                'Batu Ampar', 'Kuala Mandor', 'Kubu', 'Rasau Jaya', 'Sungai Ambawang', 'Sungai Kakap', 'Sungai Raya', 'Teluk Pakedai', 'Terentang'
            ],
            6 => ['Air Besar', 'Banyuke Hulu', 'Jelimpo', 'Kuala Bahe', 'Mandor', 'Mempawah Hulu', 'Menjalin', 'Manyuke', 'Meranti', 'Ngabang', 'Sebangki', 'Sengah Tamila', 'Sompak'],
            7 => ['Belimbing', 'Belimbing Hulu', 'Ella Hilir', 'Menukung', 'Nanga Pinoh', 'Pinoh Selatan', 'Pinoh Utara', 'Sayang', 'Sokan', 'Tanah Pinoh', 'Tanah Pinoh Barat'],
            8 =>  ['Anjongan', 'Mempawah Hilir', 'Mempawah Timur', 'Sedantang', 'Segedong', 'Siantan', 'Sungai Kunyit', 'Sungai Pinyuh', 'Toho'],
            9 => ['Galing', 'Jawai', 'Jawai Selatan', 'Paloh', 'Pemangkat', 'Sajad', 'Sajingan Besar', 'Salatiga', 'Sambas', 'Sebawi', 'Sejangkung', 'Selakau', 'Selakau Timur', 'Semparuk', 'Subah', 'Tanggaran', 'Tebas', 'Tekarang', 'Teluk Keramat'],
            10 => ['Balai', 'Beduai', 'Bonti', 'Entikong', 'Jangkang', 'Kapuas', 'Kembayan', 'Mukok', 'Noyan', 'Parindu', 'Sekayam', 'Tayan Hilir', 'Tayan Hulu', 'Toba'],
            11 => ['Belitang', 'Belitang Hilir', 'Belitang Hulu', 'Nanga Mahap', 'Nanga Taman', 'Sekadau Taman', 'Sekadau Hilir', 'Sekadau Hulu'],
            12 => ['Ambatau', 'Binjai Hulu', 'Dedai', 'Kayan Hilir', 'Kayan Hulu', 'Kelam Permai', 'Ketunggu Hilir', 'Ketungau Hulu', 'Ketungau Tengah', 'Serawau', 'Sepauk', 'Sintang', 'Sungai Tebelian', 'Tempunak'],
            13 => ['Pontianak Barat', 'Pontianak Kota', 'Pontianak Selatan', 'Pontianak Tenggara', 'Pontianak Timur', 'Pontianak Utara'],
            14 => ['Singkawang Barat', 'Singkawang Selatan', 'Singkawang Tengah', 'Singkawang Utara'],

        ];
        $jenisLampiran = ['Gerbang', 'Ruko Samping Kanan', 'Ruko Samping Kiri', 'Kondisi Jalan', 'Kondisi Saluran Kanan', 'Kondisi Saluran Kiri', 'Kondisi Fasos', 'Tampak Rumah'];
        User::factory(5)->create();
        // Jenis Lampiran
        foreach ($jenisLampiran as $value) {
            JenisLampiran::create([
                'jenis' => $value
            ]);
        }

        Provinsi::create([
            'nama' => 'Kalimantan Barat'
        ]);
        //Kabupaten
        for ($i = 0; $i < count($kabupaten); $i++) {
            Kabupaten::create([
                'provinsi_id' => '1',
                'nama' => $kabupaten[$i]
            ]);
        }
        //Kecamatan
        foreach ($kecamatan as $key => $values) {
            foreach ($values as $value) {
                Kecamatan::create([
                    'kabupaten_id' => $key,
                    'nama' => $value
                ]);
            }
        }
        // Jenis Fasos
        JenisFasos::create([
            'jenis' => 'Masjid'
        ]);
        JenisFasos::create([
            'jenis' => 'Lapangan'
        ]);
        JenisFasos::create([
            'jenis' => 'Kuburan'
        ]);

        // DetailSurveys::factory(10)->create();
        DetailSurveys::create([
            'user_id' => 1,
            'kecamatan_id' => 160,
            'tanggal_mulai' => '2022-01-01',
            'tanggal_selesai' => '2022-01-02',
            'target' => 10,
            'selesai' => 8
        ]);

        DetailSurveys::create([
            'user_id' => 2,
            'kecamatan_id' => 161,
            'tanggal_mulai' => '2022-01-03',
            'tanggal_selesai' => '2022-01-05',
            'target' => 20,
            'selesai' => 18
        ]);

        DetailSurveys::create([
            'user_id' => 3,
            'kecamatan_id' => 162,
            'tanggal_mulai' => '2022-01-06',
            'tanggal_selesai' => '2022-01-07',
            'target' => 10,
            'selesai' => 10
        ]);

        DetailSurveys::create([
            'user_id' => 4,
            'kecamatan_id' => 163,
            'tanggal_mulai' => '2022-01-01',
            'tanggal_selesai' => '2022-01-03',
            'target' => 20,
            'selesai' => 20
        ]);

        DetailSurveys::create([
            'user_id' => 5,
            'kecamatan_id' => 164,
            'tanggal_mulai' => '2022-01-03',
            'tanggal_selesai' => '2022-01-05',
            'target' => 20,
            'selesai' => 16
        ]);

        // Jenis Konstruksi Saluran
        JenisKonstruksiSaluran::create([
            'jenis' => 'Cor Beton'
        ]);
        JenisKonstruksiSaluran::create([
            'jenis' => 'Batu Kali'
        ]);
        JenisKonstruksiSaluran::create([
            'jenis' => 'Sheet Pile'
        ]);
        JenisKonstruksiSaluran::create([
            'jenis' => 'Tanah'
        ]);
        JenisKonstruksiSaluran::create([
            'jenis' => 'Uditch'
        ]);

        // Jenis Konstruksi Jalan
        JenisKonstruksiJalan::create([
            'jenis' => 'Aspal'
        ]);
        JenisKonstruksiJalan::create([
            'jenis' => 'Beton'
        ]);
        JenisKonstruksiJalan::create([
            'jenis' => 'Tanah Liat'
        ]);
        JenisKonstruksiJalan::create([
            'jenis' => 'Tanah Berbatu'
        ]);

        DataSurvey::factory(30)->create();
        LampiranFoto::factory(30)->create();
        Fasos::factory(30)->create();

        User::create([
            'nama_lengkap' => 'Seli bitri',
            'gender' => 'perempuan',
            'avatar' => "https://source.unsplash.com/128x128",
            'nomor_telepon' => '082252423199',
            'alamat' => 'Sungai Raya Dalam Arah Kubu Raya ',
            'role' => 'admin',
            'tanggal_lahir' => '1994-06-22',
            'email' => 'selibitri@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
