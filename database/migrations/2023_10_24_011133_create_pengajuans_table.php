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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik_penduduk');
            $table->unsignedBigInteger('id_jenis_surat');
            $table->string('no_dokumen_perjalanan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('nama_orangtua')->nullable();
            $table->string('nik_orangtua', 16)->nullable();
            $table->string('pekerjaan_orangtua')->nullable();
            $table->string('umur_orangtua')->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->string('jekel_orangtua')->nullable();
            $table->string('nama_jenazah')->nullable();
            $table->string('jekel_jenazah')->nullable();
            $table->string('pekerjaan_jenazah')->nullable();
            $table->string('tmp_lahir_jenazah')->nullable();
            $table->string('tgl_lahir_jenazah')->nullable();
            $table->string('agama_jenazah')->nullable();
            $table->string('alamat_jenazah')->nullable();
            $table->date('tanggal_kematian')->nullable();
            $table->datetime('waktu_kematian')->nullable();
            $table->string('sebab_kematian')->nullable();
            $table->string('tempat_kematian')->nullable();
            $table->string('saksi_keterangan_kematian')->nullable();
            $table->string('saksi_1')->nullable();
            $table->string('saksi_2')->nullable();
            $table->string('status_orang_tua')->nullable();
            $table->string('status_ibu')->nullable();
            $table->string('status_ayah')->nullable();
            $table->string('name_bayi')->nullable();
            $table->enum('jenis_kelamin_bayi', ['0', '1'])->nullable();
            $table->string('tanggal_lahir_bayi')->nullable();
            $table->datetime('waktu_lahir')->nullable();
            $table->string('tempat_dilahirkan')->nullable();
            $table->string('panjang_bayi')->nullable();
            $table->string('berat_bayi')->nullable();
            $table->string('kelahiran_ke')->nullable();
            $table->string('penolong_kelahiran')->nullable();
            $table->string('jenis_kelahiran')->nullable();
            $table->string('nik_pasangan', 16)->nullable();
            $table->string('name_pasangan')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->enum('status', ['0', '1']);
            $table->timestamps();

            $table->foreign('nik_penduduk')->references('nik')->on('penduduks')->onDelete('CASCADE');
            $table->foreign('id_jenis_surat')->references('id')->on('jenis_surats')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
