<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_pinjaman_perumahans', function (Blueprint $table) {
            $table->id();
            $table->string('no_rujukan', 32)->unique();
            $table->string('pemohon_nama');
            $table->string('bank', 100);
            $table->string('alamat_hartanah', 500);
            $table->decimal('nilai_pasaran_rm', 15, 2)->nullable();
            $table->enum('status', ['diterima', 'dalam_penilaian', 'siap_laporan', 'dihantar_bank']);
            $table->date('tarikh_terima');
            $table->date('tarikh_siap')->nullable();
            $table->string('pegawai_penilai');
            $table->timestamps();
            $table->index('status');
            $table->index('bank');
            $table->index('tarikh_terima');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_pinjaman_perumahans');
    }
};
