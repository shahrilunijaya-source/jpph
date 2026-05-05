<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseDutiSetem extends Model
{
    /** @use HasFactory<\Database\Factories\CaseDutiSetemFactory> */
    use HasFactory;

    protected $fillable = [
        'no_rujukan', 'pemohon_nama', 'pemohon_ic', 'jenis_pindahmilik',
        'nilai_hartanah_rm', 'status', 'tarikh_terima', 'tarikh_kemaskini',
        'pegawai_penilai', 'cawangan', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tarikh_terima' => 'date',
            'tarikh_kemaskini' => 'date',
            'nilai_hartanah_rm' => 'decimal:2',
        ];
    }

    public function getMaskedIcAttribute(): string
    {
        $ic = preg_replace('/\D/', '', $this->pemohon_ic);
        if (strlen($ic) < 12) return $this->pemohon_ic;
        return substr($ic, 0, 6) . '-**-' . substr($ic, -4);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'diterima' => 'Diterima',
            'dalam_semakan' => 'Dalam Semakan',
            'diluluskan' => 'Diluluskan',
            'ditolak' => 'Ditolak',
            'menunggu_dokumen' => 'Menunggu Dokumen',
            default => ucfirst($this->status),
        };
    }
}
