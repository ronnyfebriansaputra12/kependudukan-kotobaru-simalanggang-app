<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id('nik');
            $table->string('no_kk')->unique()->nullable();
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('nama');
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jekel',['Laki-laki','Perempuan'])->nullable();
            $table->string('ibu_kandung')->nullable();
            $table->string('hub_kel')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('desa')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('dusun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
