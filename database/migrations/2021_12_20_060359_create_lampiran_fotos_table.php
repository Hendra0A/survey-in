<?php

use App\Models\DataSurvey;
use App\Models\JenisLampiran;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLampiranFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampiran_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DataSurvey::class)->nullable();
            $table->foreignIdFor(JenisLampiran::class)->onDelete('cascade')->nullable();
            $table->string('foto')->nullable();

            // $table->foreign('jenis_lampirans_id')->references('id')->on('jenis_lampirans')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lampiran_fotos');
    }
}
