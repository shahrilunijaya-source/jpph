<?php

namespace Database\Seeders;

use App\Models\CaseDutiSetem;
use Illuminate\Database\Seeder;

class CaseDutiSetemSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Ahmad bin Abdullah', 'Siti Nurhaliza binti Ismail', 'Tan Wei Ming',
            'Lim Chee Hua', 'Devi Krishnan', 'Wong Mei Ling', 'Kumar Subramaniam',
            'Nor Aishah binti Yahya', 'Rajesh Pillai', 'Mohd Hafiz bin Yusof',
            'Lee Wei Sheng', 'Fatimah binti Hassan', 'Chong Kah Yew',
            'Saraswati a/p Murugan', 'Norhayati binti Daud', 'Alex Tan Boon Hock',
            'Mariam binti Razak', 'Hasrul bin Kamaruddin', 'Goh Su Yin',
            'Zulkifli bin Mahmud', 'Indra Selvi a/p Pillay', 'Ravi Kumar Nair',
            'Khairul Anwar bin Yusoff', 'Suhaila binti Mohd Salleh', 'Tan Chee Kong',
            'Mohamad Faizal bin Razak', 'Aminah binti Othman', 'Vincent Lee Chong Wei',
            'Norizan binti Ibrahim', 'Anand Krishnan',
        ];
        $cawangan = [
            'Kuala Lumpur', 'Putrajaya', 'Selangor', 'Pulau Pinang', 'Johor Bahru',
            'Shah Alam', 'Kuching', 'Kota Kinabalu', 'Ipoh', 'Melaka',
            'Seremban', 'Kuantan', 'Kota Bharu', 'Alor Setar', 'Kangar',
        ];
        $pegawai = [
            'En. Mohd Razak', 'Pn. Nor Hidayah', 'En. Tan Boon Lim',
            'Pn. Aishah Mansor', 'En. Ramli Sulaiman', 'Pn. Suriani Hashim',
        ];
        $jenis = ['jual_beli', 'hadiah', 'pewarisan', 'lain'];
        $statusBuckets = [
            'diluluskan' => 12,
            'dalam_semakan' => 8,
            'diterima' => 5,
            'menunggu_dokumen' => 3,
            'ditolak' => 2,
        ];

        $i = 1;
        foreach ($statusBuckets as $status => $n) {
            for ($k = 0; $k < $n; $k++, $i++) {
                $tarikh = now()->subDays(random_int(2, 180));
                $kemaskini = (clone $tarikh)->addDays(random_int(0, 30));
                CaseDutiSetem::query()->updateOrCreate(
                    ['no_rujukan' => sprintf('JPPH/DS/2026/%05d', $i)],
                    [
                        'pemohon_nama' => $names[array_rand($names)],
                        'pemohon_ic' => $this->fakeIc(),
                        'jenis_pindahmilik' => $jenis[array_rand($jenis)],
                        'nilai_hartanah_rm' => random_int(150_000, 2_500_000) + random_int(0, 99) / 100,
                        'status' => $status,
                        'tarikh_terima' => $tarikh,
                        'tarikh_kemaskini' => $kemaskini,
                        'pegawai_penilai' => $pegawai[array_rand($pegawai)],
                        'cawangan' => $cawangan[array_rand($cawangan)],
                        'catatan' => $status === 'menunggu_dokumen' ? 'Pemohon perlu mengemukakan salinan IC dan geran asal.' : null,
                    ],
                );
            }
        }

        // Pin a known reference for the demo flow
        CaseDutiSetem::query()->updateOrCreate(
            ['no_rujukan' => 'JPPH/DS/2026/00123'],
            [
                'pemohon_nama' => 'Ahmad Faiz bin Mohd Yusof',
                'pemohon_ic' => '850315-08-1234',
                'jenis_pindahmilik' => 'jual_beli',
                'nilai_hartanah_rm' => 750_000.00,
                'status' => 'diluluskan',
                'tarikh_terima' => now()->subDays(45),
                'tarikh_kemaskini' => now()->subDays(3),
                'pegawai_penilai' => 'En. Mohd Razak',
                'cawangan' => 'Kuala Lumpur',
                'catatan' => null,
            ],
        );
    }

    private function fakeIc(): string
    {
        $year = random_int(60, 99);
        $month = sprintf('%02d', random_int(1, 12));
        $day = sprintf('%02d', random_int(1, 28));
        $state = sprintf('%02d', random_int(1, 14));
        $serial = sprintf('%04d', random_int(1, 9999));
        return "{$year}{$month}{$day}-{$state}-{$serial}";
    }
}
