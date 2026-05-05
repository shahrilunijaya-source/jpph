<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_duti_setems', function (Blueprint $table) {
            $table->id();
            $table->string('no_rujukan', 32)->unique();
            $table->string('pemohon_nama');
            $table->string('pemohon_ic', 20);
            $table->enum('jenis_pindahmilik', ['jual_beli', 'hadiah', 'pewarisan', 'lain']);
            $table->decimal('nilai_hartanah_rm', 15, 2);
            $table->enum('status', ['diterima', 'dalam_semakan', 'diluluskan', 'ditolak', 'menunggu_dokumen']);
            $table->date('tarikh_terima');
            $table->date('tarikh_kemaskini');
            $table->string('pegawai_penilai');
            $table->string('cawangan', 100);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->index('status');
            $table->index('cawangan');
            $table->index('tarikh_terima');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_duti_setems');
    }
};
