<?php

use App\Models\DataSurvey;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasos', function (Blueprint $table) {
            $table->foreignIdFor(DataSurvey::class);
            $table->foreignId('jenis_fasos_id');
            $table->string('koordinat_fasos');
            $table->string('foto');
            $table->string('panjang');
            $table->string('lebar');
            $table->foreign('jenis_fasos_id')->references('id')->on('jenis_fasos');
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
        Schema::dropIfExists('fasos');
    }
}
