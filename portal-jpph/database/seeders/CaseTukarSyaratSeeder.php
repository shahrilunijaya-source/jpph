<?php

namespace Database\Seeders;

use App\Models\CaseTukarSyarat;
use Illuminate\Database\Seeder;

class CaseTukarSyaratSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Pelopor Hartanah Sdn Bhd', 'Sime Darby Property Berhad', 'IOI Properties Group',
            'En. Ahmad Faiz bin Mohd Yusof', 'Pn. Siti Aishah binti Hassan', 'Tan Wei Ming',
            'Lim Properties Sdn Bhd', 'Devi Krishnan & Associates', 'Permata Maju Sdn Bhd',
            'Mohd Hafiz bin Yusof', 'Rajesh Pillai Holdings', 'Suria Land Sdn Bhd',
            'Eco World Development Group', 'IJM Land Berhad', 'Mah Sing Group',
        ];
        $ptg = [
            'PTG Selangor', 'PTG Johor', 'PTG Pulau Pinang', 'PTG Perak', 'PTG Melaka',
            'PTG Sabah', 'PTG Sarawak', 'PTG Negeri Sembilan', 'PTG Kedah', 'PTG Kelantan',
        ];
        $pegawai = ['En. Ramli Sulaiman', 'Pn. Suriani Hashim', 'En. Mohd Razak', 'Pn. Aishah Mansor'];
        $statusBuckets = [
            'kelulusan_pbt' => 6,
            'siap_penilaian' => 5,
            'dalam_penilaian' => 5,
            'diterima' => 3,
        ];

        $i = 1;
        foreach ($statusBuckets as $status => $n) {
            for ($k = 0; $k < $n; $k++, $i++) {
                $tarikh = now()->subDays(random_int(5, 200));
                $siap = in_array($status, ['siap_penilaian', 'kelulusan_pbt'])
                    ? (clone $tarikh)->addDays(random_int(14, 60))
                    : null;
                CaseTukarSyarat::query()->updateOrCreate(
                    ['no_rujukan' => sprintf('JPPH/TS/2026/%05d', $i)],
                    [
                        'pemohon_nama' => $names[array_rand($names)],
                        'lot_pelan' => 'PT ' . random_int(100, 9999) . ', Mukim ' . ['Kajang', 'Klang', 'Petaling', 'Hulu Langat', 'Gombak'][array_rand(['Kajang', 'Klang', 'Petaling', 'Hulu Langat', 'Gombak'])],
                        'kategori_asal' => ['pertanian', 'bangunan', 'industri'][array_rand(['pertanian', 'bangunan', 'industri'])],
                        'kategori_baharu' => ['bangunan', 'komersial', 'campuran', 'industri'][array_rand(['bangunan', 'komersial', 'campuran', 'industri'])],
                        'keluasan_meter_persegi' => random_int(500, 25_000) + random_int(0, 99) / 100,
                        'premium_rm' => $siap ? random_int(50_000, 1_500_000) + random_int(0, 99) / 100 : null,
                        'status' => $status,
                        'tarikh_terima' => $tarikh,
                        'tarikh_siap' => $siap,
                        'pejabat_tanah' => $ptg[array_rand($ptg)],
                        'pegawai_penilai' => $pegawai[array_rand($pegawai)],
                    ],
                );
            }
        }

        // Pin a known reference for the demo flow
        CaseTukarSyarat::query()->updateOrCreate(
            ['no_rujukan' => 'JPPH/TS/2026/00789'],
            [
                'pemohon_nama' => 'Eco World Development Group',
                'lot_pelan' => 'PT 4321, Mukim Petaling',
                'kategori_asal' => 'pertanian',
                'kategori_baharu' => 'campuran',
                'keluasan_meter_persegi' => 12_500.50,
                'premium_rm' => 825_000.00,
                'status' => 'kelulusan_pbt',
                'tarikh_terima' => now()->subDays(60),
                'tarikh_siap' => now()->subDays(15),
                'pejabat_tanah' => 'PTG Selangor',
                'pegawai_penilai' => 'En. Ramli Sulaiman',
            ],
        );
    }
}
