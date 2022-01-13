<?php

use App\Models\Kabupaten;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->foreignIdFor(Kabupaten::class)->nullable();
            $table->string('avatar')->nullable();
            $table->string('nomor_telepon');
            $table->string('alamat')->nullable();
            $table->enum('role', ['surveyor', 'admin'])->default('surveyor');
            $table->date('tanggal_lahir')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
