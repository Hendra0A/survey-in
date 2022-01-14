<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kecamatan;
use App\Models\JenisKonstruksiJalan;
use App\Models\JenisKonstruksiSaluran;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataSurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users_id = User::pluck('id');
        $kecamatan_id = Kecamatan::with('kabupaten')->where('kabupaten_id', 13)->get('id');
        $jenis_konstruksi_jalan_id = JenisKonstruksiJalan::pluck('id');
        $jenis_konstruksi_saluran_id = JenisKonstruksiSaluran::pluck('id');
        return [
            'user_id' => $this->faker->randomElement($users_id),
            'kecamatan_id' => $this->faker->randomElement($kecamatan_id),
            'nama_gang' => $this->faker->streetName(),
            'lokasi' => $this->faker->address(),
            'no_gps' => $this->faker->latitude() . " " . $this->faker->latitude(),
            'jenis_konstruksi_jalan_id' => $this->faker->randomElement($jenis_konstruksi_jalan_id),
            'dimensi_jalan_panjang' => mt_rand(1000, 2000),
            'dimensi_jalan_lebar' => mt_rand(1000, 2000),
            'status_jalan' => mt_rand(30, 100),
            'jenis_konstruksi_saluran_id' => $this->faker->randomElement($jenis_konstruksi_saluran_id),
            'dimensi_saluran_panjang_kanan' => $this->faker->randomFloat(2),
            'dimensi_saluran_panjang_kiri' => $this->faker->randomFloat(2),
            'dimensi_saluran_lebar_kanan' => $this->faker->randomFloat(2),
            'dimensi_saluran_lebar_kiri' => $this->faker->randomFloat(2),
            'dimensi_saluran_kedalaman_kanan' => $this->faker->randomFloat(2),
            'dimensi_saluran_kedalaman_kiri' => $this->faker->randomFloat(2),
            'status_saluran' => mt_rand(30, 100),
            'jumlah_rumah_layak' => $this->faker->numberBetween(0, 100),
            'jumlah_rumah_tak_layak' => $this->faker->numberBetween(0, 100),
            'jumlah_rumah_kosong' => $this->faker->numberBetween(0, 100),
            'jumlah_rumah_developer' => $this->faker->numberBetween(0, 100),
            'jumlah_rumah_swadaya' => $this->faker->numberBetween(0, 100),
            'jumlah_ruko_kiri' => $this->faker->numberBetween(0, 100),
            'lantai_ruko_kiri' => $this->faker->numberBetween(0, 5),
            'jumlah_ruko_kanan' => $this->faker->numberBetween(0, 100),
            'lantai_ruko_kanan' => $this->faker->numberBetween(0, 5),
            'pos_jaga' => $this->faker->numberBetween(0, 1),
            'fasos' => $this->faker->numberBetween(0, 1),
            'no_imb' => $this->faker->postcode(),
            'catatan' => $this->faker->paragraph()
        ];
    }
}
