<?php

namespace App\Livewire\Public;

use App\Models\Announcement;
use App\Models\CaseDutiSetem;
use Livewire\Attributes\Url;
use Livewire\Component;

class Homepage extends Component
{
    #[Url(except: 'rakyat')]
    public string $audience = 'rakyat';

    public function setAudience(string $a): void
    {
        if (in_array($a, ['rakyat', 'profesional', 'warga', 'penyelidik'], true)) {
            $this->audience = $a;
        }
    }

    public function render()
    {
        $announcements = Announcement::active()->latest('published_at')->take(5)->get();

        $kpi = [
            'kes_diluluskan' => CaseDutiSetem::where('status', 'diluluskan')->count(),
            'jumlah_kes' => CaseDutiSetem::count(),
            'nilai_dinilai_rm' => (float) CaseDutiSetem::sum('nilai_hartanah_rm'),
        ];

        $microsites = $this->micrositeTiles();

        return view('livewire.public.homepage', [
            'announcements' => $announcements,
            'kpi' => $kpi,
            'microsites' => $microsites,
        ]);
    }

    private function micrositeTiles(): array
    {
        $all = [
            [
                'route' => route('microsite.duti-setem'),
                'title_ms' => 'Status Kes Duti Setem', 'title_en' => 'Stamp Duty Case Status',
                'desc_ms' => 'Semak status permohonan duti setem dengan nombor rujukan.', 'desc_en' => 'Check stamp duty application status by reference number.',
                'icon' => 'document-text', 'audiences' => ['rakyat', 'profesional'],
            ],
            [
                'route' => route('microsite.pinjaman'),
                'title_ms' => 'Status Kes Pinjaman Perumahan', 'title_en' => 'Housing Loan Case Status',
                'desc_ms' => 'Semak status penilaian pinjaman perumahan.', 'desc_en' => 'Check housing loan valuation status.',
                'icon' => 'home-modern', 'audiences' => ['rakyat', 'profesional', 'warga'],
            ],
            [
                'route' => route('microsite.tukar-syarat'),
                'title_ms' => 'Status Kes Tukar Syarat', 'title_en' => 'Land Conversion Status',
                'desc_ms' => 'Semak status premium tukar syarat tanah untuk PTG Negeri.', 'desc_en' => 'Check land conversion premium status for State Land Office.',
                'icon' => 'map', 'audiences' => ['rakyat', 'profesional'],
            ],
            [
                'route' => route('microsite.calc-duti'),
                'title_ms' => 'Pengiraan Duti Setem', 'title_en' => 'Stamp Duty Calculator',
                'desc_ms' => 'Anggaran duti setem mengikut Akta Setem 1949.', 'desc_en' => 'Estimate stamp duty per Stamp Act 1949.',
                'icon' => 'calculator', 'audiences' => ['rakyat', 'profesional'],
            ],
            [
                'route' => route('dashboard.statistik'),
                'title_ms' => 'Dashboard Statistik', 'title_en' => 'Statistics Dashboard',
                'desc_ms' => 'Statistik kes duti setem dan pinjaman perumahan masa-nyata.', 'desc_en' => 'Real-time stamp duty and housing loan case statistics.',
                'icon' => 'banknotes', 'audiences' => ['profesional', 'penyelidik', 'warga'],
            ],
            [
                'route' => 'https://napic.jpph.gov.my',
                'title_ms' => 'Data Transaksi NAPIC', 'title_en' => 'NAPIC Transaction Data',
                'desc_ms' => 'Pusat Maklumat Hartanah Negara — data terbuka.', 'desc_en' => 'National Property Information Centre — open data.',
                'icon' => 'building-office', 'external' => true,
                'audiences' => ['profesional', 'penyelidik'],
            ],
            [
                'route' => '#sembang',
                'title_ms' => 'Sembang JPPH (AI)', 'title_en' => 'JPPH Chat (AI)',
                'desc_ms' => 'Chatbot terlatih untuk soalan harta tanah dan penilaian.', 'desc_en' => 'Trained chatbot for property and valuation questions.',
                'icon' => 'sparkles', 'audiences' => ['rakyat', 'profesional', 'warga', 'penyelidik'],
            ],
            [
                'route' => route('direktori'),
                'title_ms' => 'Direktori Cawangan', 'title_en' => 'Branch Directory',
                'desc_ms' => '24 pejabat JPPH di seluruh Malaysia.', 'desc_en' => '24 JPPH offices across Malaysia.',
                'icon' => 'map', 'audiences' => ['rakyat', 'profesional', 'warga'],
            ],
            [
                'route' => route('profil'),
                'title_ms' => 'Profil Jabatan', 'title_en' => 'About JPPH',
                'desc_ms' => 'Visi, misi, peranan, dan piagam pelanggan JPPH.', 'desc_en' => 'Vision, mission, roles, and client charter.',
                'icon' => 'building-office', 'audiences' => ['rakyat', 'penyelidik'],
            ],
            [
                'route' => 'https://jpph-backend.jpph.gov.my/rpa/carian_warga?lang=ms',
                'title_ms' => 'Carian Warga JPPH', 'title_en' => 'JPPH Staff Directory',
                'desc_ms' => 'Cari pegawai JPPH mengikut bahagian dan jawatan.', 'desc_en' => 'Find JPPH officers by division and position.',
                'icon' => 'users', 'external' => true, 'audiences' => ['warga', 'profesional'],
            ],
            [
                'route' => route('page.show', 'perkhidmatan-teras'),
                'title_ms' => 'Latihan & Penerbitan', 'title_en' => 'Training & Publications',
                'desc_ms' => 'Kursus penilaian, sijil profesional, dan brosur.', 'desc_en' => 'Valuation courses, certifications, and brochures.',
                'icon' => 'academic-cap', 'audiences' => ['warga', 'penyelidik', 'profesional'],
            ],
            [
                'route' => route('page.show', 'piagam-pelanggan'),
                'title_ms' => 'Piagam Pelanggan', 'title_en' => 'Client Charter',
                'desc_ms' => 'Komitmen perkhidmatan JPPH dan KPI pencapaian.', 'desc_en' => 'JPPH service commitments and achievement KPIs.',
                'icon' => 'check-circle', 'audiences' => ['rakyat', 'profesional', 'warga'],
            ],
        ];

        return array_values(array_filter($all, fn ($t) => in_array($this->audience, $t['audiences'], true)));
    }
}
