<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);

            // lokasi
            $table->foreignId('kecamatan_id');
            $table->string('nama_gang');
            $table->string('lokasi');

            // koordinat
            $table->string('no_gps');
            $table->string('no_gps_fasos');
            $table->string('no_gps_lainnya');

            // jalan
            $table->integer('jenis_konstruksi_jalan_id');
            $table->integer('dimensi_jalan_panjang');
            $table->integer('dimensi_jalan_lebar');
            $table->integer('status_jalan');

            // saluran
            $table->integer('jenis_konstruksi_saluran_id');
            $table->integer('dimensi_saluran_panjang_kanan');
            $table->integer('dimensi_saluran_panjang_kiri');
            $table->integer('dimensi_saluran_lebar_kanan');
            $table->integer('dimensi_saluran_lebar_kiri');
            $table->integer('dimensi_saluran_kedalaman_kanan');
            $table->integer('dimensi_saluran_kedalaman_kiri');
            $table->integer('status_saluran');

            // rumah
            $table->integer('jumlah_rumah_layak');
            $table->integer('jumlah_rumah_tak_layak');
            $table->integer('jumlah_rumah_kosong');

            // rumah -> jenis
            $table->integer('jumlah_rumah_developer');
            $table->integer('jumlah_rumah_swadaya');

            // ruko
            $table->integer('jumlah_ruko_kiri');
            $table->integer('lantai_ruko_kiri');
            $table->integer('jumlah_ruko_kanan');
            $table->integer('lantai_ruko_kanan');

            $table->integer('pos_jaga');
            $table->boolean('fasos');
            $table->boolean('ruko');
            $table->string('no_imb')->default(0);

            $table->text('catatan');
            // timestamps
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kecamatan_id')->references('id')->on('kecamatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_surveys');
        // Schema::table('data_surveys', function ($table) {
        //     $table->dropForeign('data_surveys_users_id_foreign');

        //     $table->foreign('users_id')->references('id')->on('users');
        // });
    }
}
