<?php

namespace Database\Seeders;

use App\Models\CasePinjamanPerumahan;
use Illuminate\Database\Seeder;

class CasePinjamanPerumahanSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Ahmad Faiz bin Mohd Yusof', 'Siti Aminah binti Hassan', 'Tan Wei Jian',
            'Lee Mei Hua', 'Devi Krishnan', 'Wong Kar Wai', 'Kumar Subramaniam',
            'Nor Aishah binti Rahman', 'Mohd Hafiz bin Yusof', 'Lee Wei Sheng',
            'Fatimah binti Hassan', 'Chong Kah Yew', 'Saraswati a/p Murugan',
            'Norhayati binti Daud', 'Alex Tan Boon Hock', 'Mariam binti Razak',
            'Hasrul bin Kamaruddin', 'Goh Su Yin', 'Zulkifli bin Mahmud',
            'Indra Selvi a/p Pillay', 'Khairul Anwar bin Yusoff',
            'Suhaila binti Mohd Salleh', 'Tan Chee Kong', 'Vincent Lee Chong Wei',
            'Norizan binti Ibrahim',
        ];
        $banks = ['Maybank', 'CIMB Bank', 'RHB Bank', 'Public Bank', 'Bank Islam', 'Hong Leong Bank', 'AmBank'];
        $alamat = [
            'No. 12, Jalan Setia 2/5, Setia Alam, 40170 Shah Alam, Selangor',
            'B-15-3, Pangsapuri Mutiara, Jalan Bukit Bintang, 55100 Kuala Lumpur',
            'No. 88, Lorong Permai 7, Taman Permai, 81200 Johor Bahru, Johor',
            'A-22-8, Kondominium Sri Damansara, 52200 Kuala Lumpur',
            'No. 56, Jalan SS22/41, Damansara Jaya, 47400 Petaling Jaya, Selangor',
            'No. 4, Lebuh Pemancar 5, Bayan Baru, 11950 Pulau Pinang',
            'No. 23, Lorong Cempaka, Kampung Baru, 50300 Kuala Lumpur',
            'No. 17, Jalan Sutera Tanjung 8/3, Taman Sutera Utama, 81300 Skudai, Johor',
            'PT 4321, Mukim Kuala Selangor, 45000 Kuala Selangor, Selangor',
            'No. 91, Jalan Wawasan 5/2, Bandar Baru Ampang, 68000 Ampang, Selangor',
        ];
        $pegawai = ['Pn. Nor Hidayah', 'En. Tan Boon Lim', 'Pn. Aishah Mansor', 'En. Ramli Sulaiman'];
        $statusBuckets = [
            'dihantar_bank' => 8,
            'siap_laporan' => 6,
            'dalam_penilaian' => 7,
            'diterima' => 4,
        ];

        $i = 1;
        foreach ($statusBuckets as $status => $n) {
            for ($k = 0; $k < $n; $k++, $i++) {
                $tarikh = now()->subDays(random_int(2, 120));
                $siap = $status === 'dihantar_bank' || $status === 'siap_laporan'
                    ? (clone $tarikh)->addDays(random_int(7, 30))
                    : null;
                CasePinjamanPerumahan::query()->updateOrCreate(
                    ['no_rujukan' => sprintf('JPPH/PP/2026/%05d', $i)],
                    [
                        'pemohon_nama' => $names[array_rand($names)],
                        'bank' => $banks[array_rand($banks)],
                        'alamat_hartanah' => $alamat[array_rand($alamat)],
                        'nilai_pasaran_rm' => $siap ? random_int(280_000, 1_800_000) + random_int(0, 99) / 100 : null,
                        'status' => $status,
                        'tarikh_terima' => $tarikh,
                        'tarikh_siap' => $siap,
                        'pegawai_penilai' => $pegawai[array_rand($pegawai)],
                    ],
                );
            }
        }

        // Pin a known reference for the demo flow
        CasePinjamanPerumahan::query()->updateOrCreate(
            ['no_rujukan' => 'JPPH/PP/2026/00456'],
            [
                'pemohon_nama' => 'Tan Mei Ling',
                'bank' => 'Maybank',
                'alamat_hartanah' => 'B-12-3, Pangsapuri Sri Hartamas, Jalan Sri Hartamas 1, 50480 Kuala Lumpur',
                'nilai_pasaran_rm' => 685_000.00,
                'status' => 'dihantar_bank',
                'tarikh_terima' => now()->subDays(30),
                'tarikh_siap' => now()->subDays(5),
                'pegawai_penilai' => 'Pn. Nor Hidayah',
            ],
        );
    }
}
