<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasePinjamanPerumahan extends Model
{
    /** @use HasFactory<\Database\Factories\CasePinjamanPerumahanFactory> */
    use HasFactory;

    protected $fillable = [
        'no_rujukan', 'pemohon_nama', 'bank', 'alamat_hartanah',
        'nilai_pasaran_rm', 'status', 'tarikh_terima', 'tarikh_siap',
        'pegawai_penilai',
    ];

    protected function casts(): array
    {
        return [
            'tarikh_terima' => 'date',
            'tarikh_siap' => 'date',
            'nilai_pasaran_rm' => 'decimal:2',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'diterima' => 'Diterima',
            'dalam_penilaian' => 'Dalam Penilaian',
            'siap_laporan' => 'Siap Laporan',
            'dihantar_bank' => 'Dihantar Kepada Bank',
            default => ucfirst($this->status),
        };
    }
}
