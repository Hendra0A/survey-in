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
            $table->foreignIdFor(User::class)->nullable();

            // lokasi
            $table->foreignId('kecamatan_id')->nullable();
            $table->string('nama_gang')->nullable();
            $table->string('lokasi')->nullable();

            // koordinat
            $table->string('no_gps_depan')->nullable();
            $table->string('no_gps_belakang')->nullable();
            // jalan
            $table->integer('jenis_konstruksi_jalan_id')->nullable();
            $table->float('dimensi_jalan_panjang')->nullable();
            $table->float('dimensi_jalan_lebar')->nullable();
            $table->integer('status_jalan')->nullable();

            // saluran
            $table->integer('jenis_konstruksi_saluran_id')->nullable();
            $table->float('dimensi_saluran_panjang_kanan')->nullable();
            $table->float('dimensi_saluran_panjang_kiri')->nullable();
            $table->float('dimensi_saluran_lebar_kanan')->nullable();
            $table->float('dimensi_saluran_lebar_kiri')->nullable();
            $table->float('dimensi_saluran_kedalaman_kanan')->nullable();
            $table->float('dimensi_saluran_kedalaman_kiri')->nullable();
            $table->integer('status_saluran')->nullable();

            // rumah
            $table->integer('jumlah_rumah_layak')->nullable();
            $table->integer('jumlah_rumah_tak_layak')->nullable();
            $table->integer('jumlah_rumah_kosong')->nullable();

            // rumah -> jenis
            $table->integer('jumlah_rumah_developer')->nullable();
            $table->integer('jumlah_rumah_swadaya')->nullable();

            // ruko
            $table->integer('jumlah_ruko_kiri')->nullable();
            $table->integer('lantai_ruko_kiri')->nullable();
            $table->integer('jumlah_ruko_kanan')->nullable();
            $table->integer('lantai_ruko_kanan')->nullable();

            $table->integer('pos_jaga')->nullable();
            $table->boolean('fasos')->nullable();
            $table->boolean('ruko')->nullable();
            $table->string('no_imb')->default(0)->nullable();

            $table->text('catatan')->nullable();
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
