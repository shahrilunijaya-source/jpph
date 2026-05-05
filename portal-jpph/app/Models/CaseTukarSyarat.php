<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseTukarSyarat extends Model
{
    protected $fillable = [
        'no_rujukan', 'pemohon_nama', 'lot_pelan', 'kategori_asal', 'kategori_baharu',
        'keluasan_meter_persegi', 'premium_rm', 'status', 'tarikh_terima',
        'tarikh_siap', 'pejabat_tanah', 'pegawai_penilai',
    ];

    protected function casts(): array
    {
        return [
            'tarikh_terima' => 'date',
            'tarikh_siap' => 'date',
            'keluasan_meter_persegi' => 'decimal:2',
            'premium_rm' => 'decimal:2',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'diterima' => 'Diterima',
            'dalam_penilaian' => 'Dalam Penilaian',
            'siap_penilaian' => 'Siap Penilaian',
            'kelulusan_pbt' => 'Diluluskan PBT',
            default => ucfirst($this->status),
        };
    }
}
