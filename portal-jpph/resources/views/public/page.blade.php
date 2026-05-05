@php
    use App\Models\Page;
    $locale = app()->getLocale();

    // Per-slug visual treatment — icon, eyebrow, gradient accents, at-a-glance facts
    $hero = [
        'perutusan-ketua-pengarah' => [
            'icon' => 'paper-airplane', 'eyebrow_ms' => 'Perutusan', 'eyebrow_en' => 'Message',
            'tagline_ms' => 'Daripada meja Ketua Pengarah JPPH.', 'tagline_en' => 'From the desk of the Director General.',
            'glance' => [
                ['icon' => 'identification', 'label_ms' => 'Jawatan', 'label_en' => 'Position', 'value' => 'Ketua Pengarah JPPH'],
                ['icon' => 'building-library', 'label_ms' => 'Ibu Pejabat', 'label_en' => 'HQ', 'value' => 'Putrajaya'],
                ['icon' => 'flag', 'label_ms' => 'Kementerian', 'label_en' => 'Ministry', 'value' => 'KKM'],
            ],
        ],
        'latar-belakang' => [
            'icon' => 'building-office', 'eyebrow_ms' => 'Sejarah', 'eyebrow_en' => 'History',
            'tagline_ms' => 'Tujuh dekad penilaian harta tanah Malaysia.', 'tagline_en' => 'Seven decades of Malaysian property valuation.',
            'glance' => [
                ['icon' => 'flag', 'label_ms' => 'Ditubuhkan', 'label_en' => 'Established', 'value' => '1956'],
                ['icon' => 'building-library', 'label_ms' => 'Pejabat', 'label_en' => 'Offices', 'value' => '24'],
                ['icon' => 'users', 'label_ms' => 'Warga', 'label_en' => 'Staff', 'value' => '2,800+'],
            ],
        ],
        'visi-misi-objektif' => [
            'icon' => 'sparkles', 'eyebrow_ms' => 'Hala Tuju', 'eyebrow_en' => 'Direction',
            'tagline_ms' => 'Visi, misi dan objektif strategik JPPH.', 'tagline_en' => 'JPPH vision, mission and strategic objectives.',
            'glance' => [
                ['icon' => 'flag', 'label_ms' => 'Visi', 'label_en' => 'Vision', 'value' => 'Peneraju Penilaian'],
                ['icon' => 'paper-airplane', 'label_ms' => 'Misi', 'label_en' => 'Mission', 'value' => 'Bernilai · Komitmen'],
                ['icon' => 'check-circle', 'label_ms' => 'Objektif', 'label_en' => 'Objectives', 'value' => '5 Teras'],
            ],
        ],
        'peranan-jpph' => [
            'icon' => 'users', 'eyebrow_ms' => 'Peranan Strategik', 'eyebrow_en' => 'Strategic Roles',
            'tagline_ms' => 'Lima peranan teras dalam ekosistem hartanah negara.', 'tagline_en' => 'Five core roles in the national property ecosystem.',
            'glance' => [
                ['icon' => 'scale', 'label_ms' => 'Penilai Negara', 'label_en' => 'National Valuer', 'value' => 'Tunggal'],
                ['icon' => 'chart-bar', 'label_ms' => 'NAPIC', 'label_en' => 'NAPIC', 'value' => 'Pusat Data'],
                ['icon' => 'academic-cap', 'label_ms' => 'INSPEN', 'label_en' => 'INSPEN', 'value' => 'Latihan'],
            ],
        ],
        'nilai-prinsip-panduan' => [
            'icon' => 'check-circle', 'eyebrow_ms' => 'Nilai Teras', 'eyebrow_en' => 'Core Values',
            'tagline_ms' => 'Nilai dan prinsip panduan warga JPPH.', 'tagline_en' => 'Values and guiding principles for JPPH staff.',
            'glance' => [
                ['icon' => 'check-circle', 'label_ms' => 'Nilai Utama', 'label_en' => 'Core Values', 'value' => '5'],
                ['icon' => 'scale', 'label_ms' => 'Prinsip', 'label_en' => 'Principles', 'value' => 'Integriti'],
                ['icon' => 'sparkles', 'label_ms' => 'Aspirasi', 'label_en' => 'Aspiration', 'value' => 'Cemerlang'],
            ],
        ],
        'perkhidmatan-teras' => [
            'icon' => 'document-text', 'eyebrow_ms' => 'Perkhidmatan', 'eyebrow_en' => 'Services',
            'tagline_ms' => 'Tiga teras perkhidmatan: Penilaian · Penyelidikan · Latihan.', 'tagline_en' => 'Three core services: Valuation · Research · Training.',
            'glance' => [
                ['icon' => 'scale', 'label_ms' => 'Penilaian', 'label_en' => 'Valuation', 'value' => 'JPPH'],
                ['icon' => 'chart-bar', 'label_ms' => 'Penyelidikan', 'label_en' => 'Research', 'value' => 'NAPIC'],
                ['icon' => 'academic-cap', 'label_ms' => 'Latihan', 'label_en' => 'Training', 'value' => 'INSPEN'],
            ],
        ],
        'piagam-pelanggan' => [
            'icon' => 'banknotes', 'eyebrow_ms' => 'Komitmen', 'eyebrow_en' => 'Commitment',
            'tagline_ms' => 'KPI perkhidmatan kami kepada pelanggan.', 'tagline_en' => 'Our service KPIs to clients.',
            'glance' => [
                ['icon' => 'clock', 'label_ms' => 'Duti Setem', 'label_en' => 'Stamp Duty', 'value' => '14 hari'],
                ['icon' => 'home-modern', 'label_ms' => 'Pinjaman', 'label_en' => 'Housing Loan', 'value' => '7 hari'],
                ['icon' => 'check-circle', 'label_ms' => 'Aduan', 'label_en' => 'Complaints', 'value' => '3 hari'],
            ],
        ],
        'carta-organisasi' => [
            'icon' => 'users', 'eyebrow_ms' => 'Struktur', 'eyebrow_en' => 'Structure',
            'tagline_ms' => 'Carta organisasi rasmi JPPH.', 'tagline_en' => 'Official JPPH organisation chart.',
            'glance' => [
                ['icon' => 'building-library', 'label_ms' => 'Bahagian', 'label_en' => 'Divisions', 'value' => '8'],
                ['icon' => 'building-office', 'label_ms' => 'Pejabat Negeri', 'label_en' => 'State Offices', 'value' => '15'],
                ['icon' => 'users', 'label_ms' => 'Cawangan', 'label_en' => 'Branches', 'value' => '24'],
            ],
        ],
        'ketua-pegawai-digital-cdo' => [
            'icon' => 'sparkles', 'eyebrow_ms' => 'Digital', 'eyebrow_en' => 'Digital',
            'tagline_ms' => 'Peneraju transformasi digital JPPH.', 'tagline_en' => 'Leading JPPH digital transformation.',
            'glance' => [
                ['icon' => 'identification', 'label_ms' => 'Jawatan', 'label_en' => 'Role', 'value' => 'CDO JPPH'],
                ['icon' => 'sparkles', 'label_ms' => 'Mandate', 'label_en' => 'Mandate', 'value' => 'PPPA 2025'],
                ['icon' => 'chart-bar', 'label_ms' => 'Inisiatif', 'label_en' => 'Initiatives', 'value' => '12 Aktif'],
            ],
        ],
        'logo-jpph' => [
            'icon' => 'eye', 'eyebrow_ms' => 'Identiti', 'eyebrow_en' => 'Identity',
            'tagline_ms' => 'Makna lambang & garis panduan logo rasmi.', 'tagline_en' => 'Symbol meaning & official logo guidelines.',
            'glance' => [
                ['icon' => 'eye', 'label_ms' => 'Warna Utama', 'label_en' => 'Primary Colour', 'value' => 'Biru Tua'],
                ['icon' => 'sparkles', 'label_ms' => 'Aksen', 'label_en' => 'Accent', 'value' => 'Emas'],
                ['icon' => 'flag', 'label_ms' => 'Format', 'label_en' => 'Format', 'value' => 'PNG · SVG'],
            ],
        ],
        'hubungi-kami' => [
            'icon' => 'envelope', 'eyebrow_ms' => 'Perhubungan', 'eyebrow_en' => 'Contact',
            'tagline_ms' => 'Saluran rasmi untuk berhubung dengan JPPH.', 'tagline_en' => 'Official channels to reach JPPH.',
            'glance' => [
                ['icon' => 'paper-airplane', 'label_ms' => 'Talian', 'label_en' => 'Hotline', 'value' => '03-8000 8000'],
                ['icon' => 'envelope', 'label_ms' => 'Emel', 'label_en' => 'Email', 'value' => 'pertanyaan@jpph'],
                ['icon' => 'building-library', 'label_ms' => 'Alamat', 'label_en' => 'Address', 'value' => 'Putrajaya'],
            ],
        ],
        'dasar-privasi' => [
            'icon' => 'lock-closed', 'eyebrow_ms' => 'Privasi', 'eyebrow_en' => 'Privacy',
            'tagline_ms' => 'Bagaimana data peribadi anda dikendalikan.', 'tagline_en' => 'How your personal data is handled.',
            'glance' => [
                ['icon' => 'lock-closed', 'label_ms' => 'PDPA', 'label_en' => 'PDPA', 'value' => 'Akta 709'],
                ['icon' => 'check-circle', 'label_ms' => 'Pematuhan', 'label_en' => 'Compliance', 'value' => 'Penuh'],
                ['icon' => 'clock', 'label_ms' => 'Semakan', 'label_en' => 'Review', 'value' => 'Tahunan'],
            ],
        ],
        'dasar-keselamatan' => [
            'icon' => 'lock-closed', 'eyebrow_ms' => 'Keselamatan', 'eyebrow_en' => 'Security',
            'tagline_ms' => 'Komitmen keselamatan maklumat JPPH.', 'tagline_en' => 'JPPH information security commitment.',
            'glance' => [
                ['icon' => 'lock-closed', 'label_ms' => 'ISMS', 'label_en' => 'ISMS', 'value' => 'ISO 27001'],
                ['icon' => 'check-circle', 'label_ms' => 'Audit', 'label_en' => 'Audit', 'value' => 'CSO'],
                ['icon' => 'eye', 'label_ms' => 'Pemantauan', 'label_en' => 'Monitoring', 'value' => '24/7'],
            ],
        ],
    ];

    $h = $hero[$page->slug] ?? ['icon' => 'document-text', 'eyebrow_ms' => 'Maklumat', 'eyebrow_en' => 'Information', 'tagline_ms' => '', 'tagline_en' => '', 'glance' => []];

    // Related pages — fetch siblings (same group: profil core 10) excluding current
    $profilSlugs = [
        'perutusan-ketua-pengarah', 'latar-belakang', 'visi-misi-objektif', 'peranan-jpph', 'nilai-prinsip-panduan',
        'perkhidmatan-teras', 'piagam-pelanggan', 'carta-organisasi', 'ketua-pegawai-digital-cdo', 'logo-jpph',
    ];
    $isProfilPage = in_array($page->slug, $profilSlugs, true);
    $relatedSlugs = $isProfilPage
        ? collect($profilSlugs)->reject(fn ($s) => $s === $page->slug)->random(min(3, 9))
        : collect(['latar-belakang', 'visi-misi-objektif', 'hubungi-kami'])->reject(fn ($s) => $s === $page->slug)->take(3);
    $related = Page::whereIn('slug', $relatedSlugs)->where('published', true)->get();

    // Special diagram block: visi-misi gets 3 pillar cards
    $hasVMOdiagram = $page->slug === 'visi-misi-objektif';
    $hasNilaiDiagram = $page->slug === 'nilai-prinsip-panduan';
    $hasOrgDiagram = $page->slug === 'carta-organisasi';
    $hasCharterKPI = $page->slug === 'piagam-pelanggan';
@endphp
<x-layouts.portal>
    {{-- Reading progress bar --}}
    <div x-data="{ p: 0 }" x-init="window.addEventListener('scroll', () => { const h = document.documentElement; p = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100 })"
         class="fixed top-0 inset-x-0 h-1 z-50 bg-transparent">
        <div class="h-full bg-gradient-to-r from-gold via-gold-400 to-gold transition-all" :style="`width: ${p}%`"></div>
    </div>

    {{-- HERO with side illustration + animated appsoft bg --}}
    <section class="relative overflow-hidden bg-navy text-white">
        <x-portal.hero-bg variant="waves" />

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-12 pb-20 grid lg:grid-cols-[1fr_320px] gap-12 items-center">
            <div class="motion-safe:animate-fade-up">
                <nav class="text-sm text-white/60 mb-3 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hover:text-white">{{ __('Utama') }}</a>
                    <span>›</span>
                    <a href="{{ route('profil') }}" class="hover:text-white">{{ __('Profil') }}</a>
                    <span>›</span>
                    <span class="text-white truncate">{{ $page->title($locale) }}</span>
                </nav>
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-gold/15 text-gold text-xs font-semibold uppercase tracking-widest rounded-full">
                    <x-portal.icon :name="$h['icon']" class="w-3.5 h-3.5"/>
                    {{ $locale === 'ms' ? $h['eyebrow_ms'] : $h['eyebrow_en'] }}
                </span>
                <h1 class="mt-4 font-display text-4xl md:text-5xl font-bold leading-tight tracking-tight">{{ $page->title($locale) }}</h1>
                @if(($locale === 'ms' ? $h['tagline_ms'] : $h['tagline_en']))
                    <p class="mt-4 text-lg text-white/75 max-w-2xl">{{ $locale === 'ms' ? $h['tagline_ms'] : $h['tagline_en'] }}</p>
                @endif
            </div>

            {{-- Hero side illustration: large icon w/ orbit rings + float --}}
            <div class="hidden lg:flex items-center justify-center motion-safe:animate-fade-up [animation-delay:120ms]">
                <div class="relative w-72 h-72 motion-safe:animate-float-slow">
                    <div class="absolute inset-0 rounded-full border border-white/10 motion-safe:animate-[spin_30s_linear_infinite]"></div>
                    <div class="absolute inset-6 rounded-full border border-gold/20 motion-safe:animate-[spin_20s_linear_infinite_reverse]"></div>
                    <div class="absolute inset-12 rounded-full border border-white/5"></div>
                    <div class="absolute inset-16 rounded-full bg-gradient-to-br from-gold/20 to-gold/5 backdrop-blur"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        @if($page->slug === 'perutusan-ketua-pengarah')
                            <div class="w-44 h-56 rounded-2xl overflow-hidden bg-white shadow-2xl ring-4 ring-gold/40">
                                <img src="/images/ketua-pengarah.png?v=2"
                                     alt="{{ __('Ketua Pengarah Penilaian dan Perkhidmatan Harta') }}"
                                     class="w-full h-full object-cover object-top"
                                     loading="eager">
                            </div>
                        @else
                            <div class="w-32 h-32 rounded-2xl bg-white text-navy flex items-center justify-center shadow-2xl ring-4 ring-gold/30">
                                <x-portal.icon :name="$h['icon']" class="w-16 h-16"/>
                            </div>
                        @endif
                    </div>
                    {{-- decorative orbit dots --}}
                    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-3 h-3 rounded-full bg-gold shadow-lg shadow-gold/50"></div>
                    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-2 h-2 rounded-full bg-white/60"></div>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-white/40"></div>
                </div>
            </div>
        </div>

    </section>

    {{-- AT-A-GLANCE strip --}}
    @if(!empty($h['glance']))
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-navy/5 p-2 grid grid-cols-1 sm:grid-cols-3 gap-2">
                @foreach($h['glance'] as $g)
                    <div class="flex items-center gap-3 p-4 rounded-xl hover:bg-navy/[0.02] transition">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold/20 to-gold/5 text-gold-600 flex items-center justify-center shrink-0">
                            <x-portal.icon :name="$g['icon']" class="w-5 h-5"/>
                        </div>
                        <div class="min-w-0">
                            <div class="text-[10px] uppercase tracking-widest text-navy/50 font-semibold">{{ $locale === 'ms' ? $g['label_ms'] : $g['label_en'] }}</div>
                            <div class="text-sm font-display font-bold text-navy truncate">{{ $g['value'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- 2-COLUMN BODY: prose + sticky meta sidebar --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-[1fr_280px] gap-12">
            {{-- Main column --}}
            <main class="min-w-0">
                {{-- Optional diagram block: visi-misi-objektif → 3 pillar cards --}}
                @if($hasVMOdiagram)
                    <div class="grid md:grid-cols-3 gap-4 mb-10">
                        @foreach([
                            ['icon' => 'flag', 'tag_ms' => 'Visi', 'tag_en' => 'Vision', 'body_ms' => 'Menjadi peneraju penilaian harta tanah dan peneraju pengurusan harta benda kerajaan yang berinovasi.', 'body_en' => 'To be the leader in property valuation and innovative government asset management.', 'tone' => 'navy'],
                            ['icon' => 'paper-airplane', 'tag_ms' => 'Misi', 'tag_en' => 'Mission', 'body_ms' => 'Memberikan perkhidmatan penilaian dan pengurusan harta benda kerajaan secara profesional, berinovatif dan beretika.', 'body_en' => 'Provide professional, innovative and ethical valuation and government asset management services.', 'tone' => 'gold'],
                            ['icon' => 'check-circle', 'tag_ms' => 'Objektif', 'tag_en' => 'Objectives', 'body_ms' => 'Memenuhi keperluan pelanggan dengan tepat masa, berkualiti dan mematuhi standard antarabangsa.', 'body_en' => 'Meet client needs on time, with quality, and to international standards.', 'tone' => 'navy'],
                        ] as $p)
                            <div class="relative bg-white rounded-2xl p-6 ring-1 ring-navy/10 hover:ring-gold hover:shadow-lg transition motion-safe:animate-fade-up">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 {{ $p['tone'] === 'gold' ? 'bg-gold text-navy' : 'bg-navy text-gold' }}">
                                    <x-portal.icon :name="$p['icon']" class="w-6 h-6"/>
                                </div>
                                <span class="text-xs uppercase tracking-widest text-gold-600 font-semibold">{{ $locale === 'ms' ? $p['tag_ms'] : $p['tag_en'] }}</span>
                                <p class="mt-2 text-navy/80 leading-relaxed">{{ $locale === 'ms' ? $p['body_ms'] : $p['body_en'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Optional diagram: nilai-prinsip-panduan → 5-pillar grid --}}
                @if($hasNilaiDiagram)
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-10">
                        @foreach([
                            ['letter' => 'I', 'ms' => 'Integriti', 'en' => 'Integrity'],
                            ['letter' => 'A', 'ms' => 'Akauntabiliti', 'en' => 'Accountability'],
                            ['letter' => 'B', 'ms' => 'Berinovasi', 'en' => 'Innovative'],
                            ['letter' => 'P', 'ms' => 'Profesional', 'en' => 'Professional'],
                            ['letter' => 'K', 'ms' => 'Komitmen', 'en' => 'Committed'],
                        ] as $i => $v)
                            <div class="aspect-square bg-gradient-to-br from-navy to-navy-700 rounded-2xl p-4 flex flex-col justify-between text-white relative overflow-hidden motion-safe:animate-fade-up" style="animation-delay: {{ $i * 60 }}ms">
                                <span class="font-display text-5xl font-extrabold text-gold/90 leading-none">{{ $v['letter'] }}</span>
                                <span class="text-sm font-semibold leading-tight">{{ $locale === 'ms' ? $v['ms'] : $v['en'] }}</span>
                                <div class="absolute -bottom-6 -right-6 w-20 h-20 rounded-full bg-gold/10 blur-xl"></div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Optional diagram: carta-organisasi → simple SVG tree --}}
                @if($hasOrgDiagram)
                    <figure class="mb-10 bg-white rounded-2xl ring-1 ring-navy/10 p-8 overflow-x-auto">
                        <figcaption class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-4">{{ __('Rajah · Hierarki Bahagian') }}</figcaption>
                        <svg viewBox="0 0 720 320" class="w-full min-w-[640px] text-navy" style="font-family: 'Poppins', system-ui, sans-serif;">
                            {{-- Root: Ketua Pengarah --}}
                            <rect x="280" y="10" width="160" height="50" rx="10" fill="#0A2540"/>
                            <text x="360" y="40" text-anchor="middle" fill="#fff" font-weight="700" font-size="14">Ketua Pengarah</text>
                            {{-- Connecting lines --}}
                            <line x1="360" y1="60" x2="360" y2="100" stroke="#F59E0B" stroke-width="2"/>
                            <line x1="80" y1="100" x2="640" y2="100" stroke="#F59E0B" stroke-width="2"/>
                            @foreach([
                                ['x' => 30, 'label' => 'Pengurusan'],
                                ['x' => 170, 'label' => 'Penilaian'],
                                ['x' => 310, 'label' => 'NAPIC'],
                                ['x' => 450, 'label' => 'INSPEN'],
                                ['x' => 590, 'label' => 'Digital'],
                            ] as $i => $b)
                                <line x1="{{ $b['x'] + 50 }}" y1="100" x2="{{ $b['x'] + 50 }}" y2="130" stroke="#F59E0B" stroke-width="2"/>
                                <rect x="{{ $b['x'] }}" y="130" width="100" height="46" rx="8" fill="#fff" stroke="#0A2540" stroke-width="1.5"/>
                                <text x="{{ $b['x'] + 50 }}" y="159" text-anchor="middle" fill="#0A2540" font-weight="600" font-size="12">{{ $b['label'] }}</text>
                                {{-- Sub-units --}}
                                <line x1="{{ $b['x'] + 50 }}" y1="176" x2="{{ $b['x'] + 50 }}" y2="210" stroke="#0A2540" stroke-width="1" stroke-dasharray="3,3" opacity="0.4"/>
                                <rect x="{{ $b['x'] + 10 }}" y="210" width="80" height="34" rx="6" fill="#FEF3C7" stroke="#F59E0B" stroke-width="1" stroke-opacity="0.5"/>
                                <text x="{{ $b['x'] + 50 }}" y="232" text-anchor="middle" fill="#0A2540" font-size="10">15 unit</text>
                            @endforeach
                            <text x="360" y="290" text-anchor="middle" fill="#0A2540" font-size="11" opacity="0.6">{{ __('Carta ringkas — versi penuh tersedia di laman') }}</text>
                        </svg>
                    </figure>
                @endif

                {{-- Optional diagram: piagam-pelanggan → KPI cards --}}
                @if($hasCharterKPI)
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-10">
                        @foreach([
                            ['kpi' => '14', 'unit_ms' => 'hari', 'unit_en' => 'days', 'label_ms' => 'Penilaian Duti Setem', 'label_en' => 'Stamp Duty Valuation', 'icon' => 'document-text'],
                            ['kpi' => '7', 'unit_ms' => 'hari', 'unit_en' => 'days', 'label_ms' => 'Pinjaman Perumahan', 'label_en' => 'Housing Loan', 'icon' => 'home-modern'],
                            ['kpi' => '3', 'unit_ms' => 'hari', 'unit_en' => 'days', 'label_ms' => 'Maklum Balas Aduan', 'label_en' => 'Complaint Response', 'icon' => 'chat-bubble-left-right'],
                            ['kpi' => '95', 'unit_ms' => '%', 'unit_en' => '%', 'label_ms' => 'Kepuasan Pelanggan', 'label_en' => 'Client Satisfaction', 'icon' => 'check-circle'],
                        ] as $k)
                            <div class="bg-white rounded-2xl p-5 ring-1 ring-navy/10 hover:ring-gold hover:shadow-lg transition motion-safe:animate-fade-up">
                                <div class="flex items-center justify-between">
                                    <div class="w-9 h-9 rounded-lg bg-gold/10 text-gold-600 flex items-center justify-center">
                                        <x-portal.icon :name="$k['icon']" class="w-5 h-5"/>
                                    </div>
                                </div>
                                <div class="mt-3 flex items-baseline gap-1">
                                    <span class="font-display text-4xl font-extrabold text-navy">{{ $k['kpi'] }}</span>
                                    <span class="text-sm text-navy/60">{{ $locale === 'ms' ? $k['unit_ms'] : $k['unit_en'] }}</span>
                                </div>
                                <p class="mt-1 text-xs text-navy/60">{{ $locale === 'ms' ? $k['label_ms'] : $k['label_en'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Officer card for perutusan-ketua-pengarah --}}
                @if($page->slug === 'perutusan-ketua-pengarah')
                    <div class="mb-10 bg-white ring-1 ring-navy/10 rounded-2xl p-6 flex flex-col sm:flex-row items-center sm:items-start gap-6 shadow-sm">
                        <div class="w-32 h-40 sm:w-36 sm:h-48 rounded-xl overflow-hidden ring-1 ring-navy/10 shrink-0 bg-navy/5">
                            <img src="/images/ketua-pengarah.png?v=2"
                                 alt="{{ __('Ketua Pengarah Penilaian dan Perkhidmatan Harta') }}"
                                 class="w-full h-full object-cover object-top">
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest bg-gold/15 text-gold-600">
                                <x-portal.icon name="identification" class="w-3 h-3"/>
                                {{ __('Pegawai Utama') }}
                            </span>
                            <h3 class="mt-2 font-display text-xl md:text-2xl font-bold text-navy">{{ __('Ketua Pengarah Penilaian dan Perkhidmatan Harta') }}</h3>
                            <p class="mt-1 text-sm text-navy/60">{{ __('Kementerian Kewangan Malaysia') }}</p>
                            <p class="mt-3 text-sm text-navy/70 leading-relaxed">{{ __('Nama rasmi pegawai semasa boleh dirujuk di laman web rasmi JPPH atau Direktori Warga JPPH.') }}</p>
                            <div class="mt-3 flex flex-wrap justify-center sm:justify-start gap-2 text-xs">
                                <a href="https://www.jpph.gov.my" target="_blank" rel="noopener" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-navy/5 hover:bg-navy/10 text-navy/80 transition">
                                    <x-portal.icon name="building-office" class="w-3 h-3"/>
                                    jpph.gov.my
                                </a>
                                <a href="https://jpph-backend.jpph.gov.my/rpa/carian_warga?lang=ms" target="_blank" rel="noopener" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-navy/5 hover:bg-navy/10 text-navy/80 transition">
                                    <x-portal.icon name="users" class="w-3 h-3"/>
                                    {{ __('Carian Warga') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Article body --}}
                <article class="prose-jpph">
                    {!! $page->body($locale) !!}
                </article>

                {{-- Google Map: hubungi-kami only --}}
                @if($page->slug === 'hubungi-kami')
                    <figure class="mt-10 rounded-2xl overflow-hidden ring-1 ring-navy/10 shadow-sm bg-white">
                        <figcaption class="px-5 py-3 text-xs uppercase tracking-widest text-gold-600 font-semibold border-b border-navy/10 flex items-center gap-2">
                            <x-portal.icon name="map" class="w-4 h-4"/>
                            {{ __('Lokasi · Ibu Pejabat JPPH') }}
                        </figcaption>
                        <iframe
                            src="https://www.google.com/maps?q=Kompleks+Kementerian+Kewangan+Persiaran+Perdana+Presint+2+62592+Putrajaya&output=embed"
                            width="100%" height="360"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="{{ __('Peta Ibu Pejabat JPPH') }}"
                            allowfullscreen></iframe>
                        <div class="px-5 py-3 text-sm text-navy/70 flex flex-wrap items-center justify-between gap-2 border-t border-navy/10">
                            <span>{{ __('Aras 4-7, Blok A, Kompleks Kementerian Kewangan, Presint 2, Putrajaya') }}</span>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=Kompleks+Kementerian+Kewangan+Putrajaya"
                               target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 text-gold-600 hover:text-gold-700 font-semibold">
                                {{ __('Dapatkan Arah') }}
                                <x-portal.icon name="arrow-top-right" class="w-3.5 h-3.5"/>
                            </a>
                        </div>
                    </figure>
                @endif

                {{-- CTA card --}}
                <div class="mt-12 bg-gradient-to-br from-navy to-navy-700 text-white rounded-2xl p-8 md:p-10 relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-gold/15 blur-3xl pointer-events-none"></div>
                    <div class="relative grid md:grid-cols-[1fr_auto] gap-6 items-center">
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Perlu Bantuan?') }}</span>
                            <h3 class="mt-2 font-display text-2xl md:text-3xl font-bold">{{ __('Hubungi JPPH untuk maklumat lanjut') }}</h3>
                            <p class="mt-2 text-white/70">{{ __('Pasukan perkhidmatan pelanggan kami sedia membantu sebarang pertanyaan.') }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row md:flex-col gap-2">
                            <a href="{{ route('page.show', 'hubungi-kami') }}" class="px-5 py-3 bg-gold hover:bg-gold-400 text-navy font-semibold rounded-lg transition inline-flex items-center justify-center gap-2">
                                <x-portal.icon name="envelope" class="w-4 h-4"/>
                                {{ __('Hubungi Kami') }}
                            </a>
                            <a href="{{ route('home') }}#faq" class="px-5 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition inline-flex items-center justify-center gap-2">
                                <x-portal.icon name="question-mark-circle" class="w-4 h-4"/>
                                {{ __('Soalan Lazim') }}
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            {{-- Sticky right rail --}}
            <aside class="lg:sticky lg:top-28 self-start space-y-6">
                <div class="bg-white rounded-2xl ring-1 ring-navy/10 p-5">
                    <h4 class="text-[10px] uppercase tracking-widest text-gold-600 font-bold">{{ __('Maklumat Halaman') }}</h4>
                    <dl class="mt-3 space-y-3 text-sm">
                        <div class="flex items-start gap-2">
                            <x-portal.icon name="clock" class="w-4 h-4 mt-0.5 text-navy/40 shrink-0"/>
                            <div>
                                <dt class="text-navy/50 text-xs">{{ __('Dikemas kini') }}</dt>
                                <dd class="text-navy font-medium">{{ optional($page->updated_at)->isoFormat('D MMM YYYY') ?? '—' }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-portal.icon name="globe-asia" class="w-4 h-4 mt-0.5 text-navy/40 shrink-0"/>
                            <div>
                                <dt class="text-navy/50 text-xs">{{ __('Bahasa') }}</dt>
                                <dd class="text-navy font-medium">{{ strtoupper($locale) }} · BM/EN</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-portal.icon name="check-circle" class="w-4 h-4 mt-0.5 text-green-600 shrink-0"/>
                            <div>
                                <dt class="text-navy/50 text-xs">{{ __('Status') }}</dt>
                                <dd class="text-green-700 font-medium">{{ __('Diterbitkan') }}</dd>
                            </div>
                        </div>
                    </dl>
                </div>

                <div class="bg-white rounded-2xl ring-1 ring-navy/10 p-5" x-data="{ copied: false }">
                    <h4 class="text-[10px] uppercase tracking-widest text-gold-600 font-bold mb-3">{{ __('Tindakan') }}</h4>
                    <div class="space-y-2">
                        <button type="button" onclick="window.print()" class="w-full inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-navy hover:bg-navy/5 transition">
                            <x-portal.icon name="document-text" class="w-4 h-4"/>
                            {{ __('Cetak Halaman') }}
                        </button>
                        <button type="button"
                                x-on:click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-full inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-navy hover:bg-navy/5 transition">
                            <x-portal.icon name="paper-airplane" class="w-4 h-4"/>
                            <span x-show="!copied">{{ __('Salin Pautan') }}</span>
                            <span x-show="copied" x-cloak class="text-green-600 font-semibold">{{ __('Disalin ✓') }}</span>
                        </button>
                        <a href="{{ route('home') }}#faq" class="w-full inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-navy hover:bg-navy/5 transition">
                            <x-portal.icon name="chat-bubble-left-right" class="w-4 h-4"/>
                            {{ __('Tanya Sembang JPPH') }}
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-gold/15 to-gold/5 ring-1 ring-gold/30 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <x-portal.icon name="light-bulb" class="w-6 h-6 text-gold-600 shrink-0"/>
                        <div>
                            <h4 class="font-display font-bold text-navy text-sm">{{ __('Tahukah Anda?') }}</h4>
                            <p class="mt-1 text-xs text-navy/70 leading-relaxed">{{ __('JPPH menyediakan perkhidmatan penilaian percuma untuk kes duti setem dengan nilai tertentu di bawah Akta Setem 1949.') }}</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    {{-- RELATED PAGES --}}
    @if($related->count())
        <section class="bg-navy/[0.02] border-t border-navy/5">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <span class="text-xs uppercase tracking-widest text-gold-600 font-semibold">{{ __('Baca Juga') }}</span>
                        <h2 class="mt-1 text-2xl md:text-3xl font-display font-bold text-navy">{{ __('Halaman Berkaitan') }}</h2>
                    </div>
                    <a href="{{ route('profil') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-gold-600 hover:text-gold">
                        {{ __('Lihat semua') }}
                        <x-portal.icon name="arrow-right" class="w-3.5 h-3.5"/>
                    </a>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($related as $r)
                        @php $ri = $hero[$r->slug]['icon'] ?? 'document-text'; @endphp
                        <a href="{{ route('page.show', $r->slug) }}"
                           class="group bg-white rounded-2xl p-6 ring-1 ring-navy/10 hover:ring-gold hover:-translate-y-1 hover:shadow-xl transition-all">
                            <div class="w-10 h-10 rounded-lg bg-navy/5 group-hover:bg-gold/10 text-navy group-hover:text-gold-600 flex items-center justify-center transition">
                                <x-portal.icon :name="$ri" class="w-5 h-5"/>
                            </div>
                            <h3 class="mt-3 font-display font-bold text-navy leading-tight">{{ $r->title($locale) }}</h3>
                            <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-gold-600 group-hover:gap-2 transition-all">
                                {{ __('Baca') }}
                                <x-portal.icon name="arrow-right" class="w-3 h-3"/>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- bottom nav --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 flex items-center justify-between text-sm">
        <a href="{{ route('profil') }}" class="text-gold-600 hover:text-gold inline-flex items-center gap-1 font-semibold">
            ← {{ __('Kembali ke Profil Jabatan') }}
        </a>
        <a href="{{ route('home') }}" class="text-navy/60 hover:text-navy">
            {{ __('Halaman Utama') }} →
        </a>
    </section>
</x-layouts.portal>
