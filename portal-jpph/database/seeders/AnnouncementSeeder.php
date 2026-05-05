<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title_bm' => 'Cetak Angka Giliran Peperiksaan Perkhidmatan Penilaian Sesi Mei 2026',
                'title_en' => 'Print Examination Queue Number for Valuation Service May 2026',
                'excerpt_bm' => 'Calon yang berdaftar boleh mencetak angka giliran peperiksaan bermula 5 Mei 2026 melalui portal rasmi JPPH.',
                'excerpt_en' => 'Registered candidates may print examination queue numbers starting 5 May 2026 via the JPPH official portal.',
                'image_path' => null,
                'published_at' => now()->subDays(2),
                'expires_at' => now()->addDays(30),
            ],
            [
                'title_bm' => 'Laporan Pencapaian Piagam Pelanggan Suku Tahun Pertama 2026',
                'title_en' => 'Customer Charter Performance Report Q1 2026',
                'excerpt_bm' => 'JPPH mencatatkan pencapaian 96.4% dalam tempoh penyiapan laporan penilaian dalam suku tahun pertama 2026.',
                'excerpt_en' => 'JPPH recorded 96.4% achievement in valuation report turnaround time during Q1 2026.',
                'image_path' => null,
                'published_at' => now()->subDays(7),
                'expires_at' => null,
            ],
            [
                'title_bm' => 'Naik Taraf Sistem MyJPPH 12 Mei 2026 - Tempoh Senggara Terancang',
                'title_en' => 'MyJPPH System Upgrade 12 May 2026 - Planned Maintenance Window',
                'excerpt_bm' => 'Sistem akan dimatikan dari 11.00 malam hingga 6.00 pagi pada 12 Mei 2026 bagi penyenggaraan rutin.',
                'excerpt_en' => 'System will be down from 11:00pm to 6:00am on 12 May 2026 for routine maintenance.',
                'image_path' => null,
                'published_at' => now()->subDays(1),
                'expires_at' => now()->addDays(10),
            ],
            [
                'title_bm' => 'Bengkel Penilaian Hartanah untuk Bank-Bank Tempatan',
                'title_en' => 'Property Valuation Workshop for Local Banks',
                'excerpt_bm' => 'JPPH akan mengadakan bengkel teknikal pada 20 Mei 2026 di Putrajaya untuk pegawai penilaian bank-bank perdagangan.',
                'excerpt_en' => 'JPPH will host a technical workshop on 20 May 2026 in Putrajaya for commercial bank valuation officers.',
                'image_path' => null,
                'published_at' => now()->subDays(4),
                'expires_at' => now()->addDays(20),
            ],
            [
                'title_bm' => 'Hari Penilaian Sedunia 2025 - JPPH Anjur Pameran',
                'title_en' => 'World Valuation Day 2025 - JPPH Exhibition',
                'excerpt_bm' => 'Sambutan Hari Penilaian Sedunia diadakan di Pusat Konvensyen Kuala Lumpur pada Oktober 2025.',
                'excerpt_en' => 'World Valuation Day celebration held at Kuala Lumpur Convention Centre in October 2025.',
                'image_path' => null,
                'published_at' => now()->subDays(180),
                'expires_at' => now()->subDays(60),
            ],
        ];

        foreach ($items as $item) {
            Announcement::query()->updateOrCreate(['title_bm' => $item['title_bm']], $item);
        }
    }
}
