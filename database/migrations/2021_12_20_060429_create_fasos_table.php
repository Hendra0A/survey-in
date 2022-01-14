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
            $table->id();
            $table->foreignIdFor(DataSurvey::class)->nullable();
            $table->foreignId('jenis_fasos_id')->nullable();
            $table->string('koordinat_fasos')->nullable();
            $table->string('foto')->nullable();
            $table->string('panjang')->nullable();
            $table->string('lebar')->nullable();
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
