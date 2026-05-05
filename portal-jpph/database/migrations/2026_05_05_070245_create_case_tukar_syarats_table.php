<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_tukar_syarats', function (Blueprint $table) {
            $table->id();
            $table->string('no_rujukan', 32)->unique();
            $table->string('pemohon_nama');
            $table->string('lot_pelan', 100); // e.g. PT 1234, Mukim X
            $table->enum('kategori_asal', ['pertanian', 'bangunan', 'industri']);
            $table->enum('kategori_baharu', ['pertanian', 'bangunan', 'industri', 'komersial', 'campuran']);
            $table->decimal('keluasan_meter_persegi', 12, 2);
            $table->decimal('premium_rm', 15, 2)->nullable();
            $table->enum('status', ['diterima', 'dalam_penilaian', 'siap_penilaian', 'kelulusan_pbt']);
            $table->date('tarikh_terima');
            $table->date('tarikh_siap')->nullable();
            $table->string('pejabat_tanah', 100); // PTG yang memohon
            $table->string('pegawai_penilai');
            $table->timestamps();
            $table->index('status');
            $table->index('pejabat_tanah');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_tukar_syarats');
    }
};
