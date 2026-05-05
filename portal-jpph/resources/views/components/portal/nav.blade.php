@php
    $locale = app()->getLocale();
    $other = $locale === 'ms' ? 'en' : 'ms';

    // Mega menu structure
    $menu = [
        [
            'label_ms' => 'Profil', 'label_en' => 'About',
            'sections' => [
                [
                    'heading_ms' => 'Mengenai JPPH', 'heading_en' => 'About JPPH',
                    'items' => [
                        ['label_ms' => 'Perutusan Ketua Pengarah', 'label_en' => 'Director General\'s Message', 'route' => route('page.show', 'perutusan-ketua-pengarah'), 'icon' => 'paper-airplane'],
                        ['label_ms' => 'Latar Belakang', 'label_en' => 'Background', 'route' => route('page.show', 'latar-belakang'), 'icon' => 'building-office'],
                        ['label_ms' => 'Visi, Misi & Objektif', 'label_en' => 'Vision, Mission & Objectives', 'route' => route('page.show', 'visi-misi-objektif'), 'icon' => 'sparkles'],
                        ['label_ms' => 'Peranan JPPH', 'label_en' => 'Roles of JPPH', 'route' => route('page.show', 'peranan-jpph'), 'icon' => 'users'],
                        ['label_ms' => 'Nilai & Prinsip Panduan', 'label_en' => 'Values & Principles', 'route' => route('page.show', 'nilai-prinsip-panduan'), 'icon' => 'check-circle'],
                    ],
                ],
                [
                    'heading_ms' => 'Pengurusan', 'heading_en' => 'Management',
                    'items' => [
                        ['label_ms' => 'Perkhidmatan Teras', 'label_en' => 'Core Services', 'route' => route('page.show', 'perkhidmatan-teras'), 'icon' => 'document-text'],
                        ['label_ms' => 'Piagam Pelanggan', 'label_en' => 'Client Charter', 'route' => route('page.show', 'piagam-pelanggan'), 'icon' => 'banknotes'],
                        ['label_ms' => 'Carta Organisasi', 'label_en' => 'Organisation Chart', 'route' => route('page.show', 'carta-organisasi'), 'icon' => 'users'],
                        ['label_ms' => 'Ketua Pegawai Digital (CDO)', 'label_en' => 'Chief Digital Officer (CDO)', 'route' => route('page.show', 'ketua-pegawai-digital-cdo'), 'icon' => 'sparkles'],
                        ['label_ms' => 'Logo JPPH', 'label_en' => 'JPPH Logo', 'route' => route('page.show', 'logo-jpph'), 'icon' => 'eye'],
                    ],
                ],
            ],
            'cta' => ['label_ms' => 'Lihat semua →', 'label_en' => 'View all →', 'route' => route('profil')],
        ],
        [
            'label_ms' => 'Perkhidmatan', 'label_en' => 'Services',
            'sections' => [
                [
                    'heading_ms' => 'Semakan Status', 'heading_en' => 'Status Lookup',
                    'items' => [
                        ['label_ms' => 'Status Kes Duti Setem', 'label_en' => 'Stamp Duty Case Status', 'route' => route('microsite.duti-setem'), 'icon' => 'document-text'],
                        ['label_ms' => 'Status Kes Pinjaman Perumahan', 'label_en' => 'Housing Loan Status', 'route' => route('microsite.pinjaman'), 'icon' => 'home-modern'],
                        ['label_ms' => 'Status Kes Tukar Syarat', 'label_en' => 'Land Conversion Status', 'route' => route('microsite.tukar-syarat'), 'icon' => 'map'],
                    ],
                ],
                [
                    'heading_ms' => 'Alat & Data', 'heading_en' => 'Tools & Data',
                    'items' => [
                        ['label_ms' => 'Pengiraan Duti Setem', 'label_en' => 'Stamp Duty Calculator', 'route' => route('microsite.calc-duti'), 'icon' => 'calculator'],
                        ['label_ms' => 'Dashboard Statistik', 'label_en' => 'Statistics Dashboard', 'route' => route('dashboard.statistik'), 'icon' => 'banknotes'],
                        ['label_ms' => 'Data Transaksi NAPIC', 'label_en' => 'NAPIC Transaction Data', 'route' => 'https://napic.jpph.gov.my', 'icon' => 'building-office', 'external' => true],
                        ['label_ms' => 'Carian Penilai Bertauliah', 'label_en' => 'Licensed Valuer Lookup', 'icon' => 'identification', 'soon' => true],
                        ['label_ms' => 'Borang Permohonan', 'label_en' => 'Application Forms', 'icon' => 'document-text', 'soon' => true],
                    ],
                ],
            ],
            'cta' => ['label_ms' => 'Semua perkhidmatan →', 'label_en' => 'All services →', 'route' => route('home') . '#microsite'],
        ],
        [
            'label_ms' => 'Hubungi', 'label_en' => 'Contact',
            'sections' => [
                [
                    'heading_ms' => 'Direktori', 'heading_en' => 'Directory',
                    'items' => [
                        ['label_ms' => 'Direktori Cawangan JPPH', 'label_en' => 'JPPH Branch Directory', 'route' => route('direktori'), 'icon' => 'map'],
                        ['label_ms' => 'Carian Cawangan Penilaian', 'label_en' => 'Valuation Branch Search', 'route' => 'https://jpph-backend.jpph.gov.my/rpa/carian_penilaian?lang=ms', 'icon' => 'magnifying-glass', 'external' => true],
                        ['label_ms' => 'Carian Warga JPPH', 'label_en' => 'Staff Directory', 'route' => 'https://jpph-backend.jpph.gov.my/rpa/carian_warga?lang=ms', 'icon' => 'users', 'external' => true],
                    ],
                ],
                [
                    'heading_ms' => 'Maklumat Tambahan', 'heading_en' => 'More Info',
                    'items' => [
                        ['label_ms' => 'Hubungi Kami', 'label_en' => 'Contact Us', 'route' => route('page.show', 'hubungi-kami'), 'icon' => 'envelope'],
                        ['label_ms' => 'Soalan Lazim', 'label_en' => 'FAQ', 'route' => route('home') . '#faq', 'icon' => 'question-mark-circle'],
                        ['label_ms' => 'Aduan & Maklum Balas', 'label_en' => 'Feedback & Complaints', 'route' => 'https://jpph-backend.jpph.gov.my/rpa/aduan?lang=ms', 'icon' => 'chat-bubble-left-right', 'external' => true],
                        ['label_ms' => 'ePerolehan JPPH', 'label_en' => 'JPPH eProcurement', 'icon' => 'flag', 'soon' => true],
                        ['label_ms' => 'Tender & Sebut Harga', 'label_en' => 'Tenders & Quotations', 'icon' => 'newspaper', 'soon' => true],
                    ],
                ],
            ],
            'cta' => ['label_ms' => 'Direktori penuh →', 'label_en' => 'Full directory →', 'route' => route('direktori')],
        ],
    ];

    $pppa = [
        ['label_ms' => 'Soalan Lazim', 'label_en' => 'FAQ', 'icon' => 'question-mark-circle', 'route' => route('home') . '#faq'],
        ['label_ms' => 'Hubungi Kami', 'label_en' => 'Contact Us', 'icon' => 'envelope', 'route' => route('page.show', 'hubungi-kami')],
        ['label_ms' => 'Aduan & Maklum Balas', 'label_en' => 'Feedback', 'icon' => 'chat-bubble-left-right', 'route' => '#'],
        ['label_ms' => 'Peta Laman', 'label_en' => 'Sitemap', 'icon' => 'map', 'route' => route('profil')],
    ];
@endphp
<header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-navy/10" x-data="{ open: false, megaIdx: null }">
    {{-- Top utility strip --}}
    <div class="bg-navy text-white text-xs">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-end gap-4">
            <div class="flex items-center gap-4 ml-auto">
                <ul class="hidden md:flex items-center gap-1">
                    @foreach($pppa as $link)
                        <li>
                            <a href="{{ $link['route'] }}" class="inline-flex items-center gap-1.5 px-2 py-1 rounded hover:bg-white/10 transition">
                                <x-portal.icon :name="$link['icon']" class="w-3.5 h-3.5"/>
                                <span>{{ $locale === 'ms' ? $link['label_ms'] : $link['label_en'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('locale.switch', $other) }}" class="inline-flex items-center gap-1 px-2 py-1 rounded border border-white/30 hover:bg-white/10 transition" aria-label="{{ __('Tukar bahasa') }}">
                    <span class="font-semibold">{{ strtoupper($locale) }}</span>
                    <span class="opacity-50">/</span>
                    <span class="opacity-70">{{ strtoupper($other) }}</span>
                </a>
                <button type="button"
                    x-on:click="mode = mode === 'oku' ? '' : 'oku'; localStorage.setItem('jpph-mode', mode); document.documentElement.setAttribute('data-mode', mode)"
                    class="inline-flex items-center gap-1 px-2 py-1 rounded border border-white/30 hover:bg-white/10 transition"
                    :aria-pressed="mode === 'oku'"
                    aria-label="{{ __('Mod Aksesibiliti OKU') }}">
                    <x-portal.icon name="eye" class="w-3.5 h-3.5"/>
                    <span class="hidden sm:inline">OKU</span>
                </button>

                {{-- MyJPPH intranet login (warga only) --}}
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-gold text-navy font-semibold hover:bg-gold-400 transition shadow-sm"
                   title="{{ __('Log masuk MyJPPH (warga JPPH sahaja)') }}">
                    <x-portal.icon name="building-library" class="w-3.5 h-3.5"/>
                    <span>MyJPPH</span>
                    <span class="hidden md:inline opacity-70 text-[10px] uppercase tracking-wider">{{ __('Intranet') }}</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Main brand row --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="{{ __('Halaman Utama JPPH') }}">
                <img src="/images/jata-negara.png" alt="{{ __('Jata Negara Malaysia') }}" class="h-14 w-14 object-contain shrink-0">
                <span class="hidden sm:flex flex-col leading-tight">
                    <span class="text-[10px] uppercase tracking-widest text-navy/60">{{ __('Laman Web Rasmi') }}</span>
                    <span class="font-display font-bold text-navy text-lg">{{ __('Jabatan Penilaian dan Perkhidmatan Harta') }}</span>
                    <span class="text-[11px] text-navy/60">{{ __('Kementerian Kewangan Malaysia') }}</span>
                </span>
                <span class="hidden md:block h-10 w-px bg-navy/15 mx-1"></span>
                <img src="/images/jpph-logo.png" alt="{{ __('Logo JPPH') }}" class="hidden md:block h-12 w-12 object-contain shrink-0">
            </a>

            {{-- Desktop primary nav (mega menu) --}}
            <nav class="hidden lg:flex items-center gap-1 relative" aria-label="{{ __('Navigasi utama') }}"
                 x-on:mouseleave="megaIdx = null">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium text-navy/80 hover:text-navy hover:bg-navy/5 transition">
                    {{ __('Utama') }}
                </a>
                @foreach($menu as $i => $top)
                    <button type="button"
                            x-on:mouseenter="megaIdx = {{ $i }}"
                            x-on:focus="megaIdx = {{ $i }}"
                            class="px-3 py-2 rounded-md text-sm font-medium transition inline-flex items-center gap-1"
                            :class="megaIdx === {{ $i }} ? 'text-navy bg-navy/5' : 'text-navy/80 hover:text-navy hover:bg-navy/5'">
                        {{ $locale === 'ms' ? $top['label_ms'] : $top['label_en'] }}
                        <svg class="w-3 h-3 transition" :class="megaIdx === {{ $i }} ? 'rotate-180' : ''" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M1 1.5l5 5 5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                @endforeach
                <a href="{{ route('dashboard.statistik') }}" class="px-3 py-2 rounded-md text-sm font-medium text-navy/80 hover:text-navy hover:bg-navy/5 transition">
                    {{ __('Statistik') }}
                </a>

                {{-- Mega panels --}}
                @foreach($menu as $i => $top)
                    <div x-show="megaIdx === {{ $i }}"
                         x-transition.opacity.duration.150ms
                         x-cloak
                         class="absolute top-full left-0 right-0 mt-1 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-navy/10 p-8 grid grid-cols-2 gap-8 w-[640px] max-w-[90vw]">
                            @foreach($top['sections'] as $sec)
                                <div>
                                    <h4 class="text-xs uppercase tracking-widest text-gold font-semibold mb-3">{{ $locale === 'ms' ? $sec['heading_ms'] : $sec['heading_en'] }}</h4>
                                    <ul class="space-y-1">
                                        @foreach($sec['items'] as $item)
                                            <li>
                                                @if($item['soon'] ?? false)
                                                    <x-portal.coming-soon-link
                                                        :icon="$item['icon']"
                                                        :label="$locale === 'ms' ? $item['label_ms'] : $item['label_en']"
                                                        variant="menu" />
                                                @else
                                                    <a href="{{ $item['route'] }}" @if($item['external'] ?? false) target="_blank" rel="noopener" @endif
                                                       class="flex items-start gap-3 px-3 py-2 -mx-3 rounded-lg hover:bg-navy/5 transition group">
                                                        <span class="w-8 h-8 rounded-lg bg-navy/5 group-hover:bg-gold/15 text-navy group-hover:text-gold-600 flex items-center justify-center shrink-0 transition">
                                                            <x-portal.icon :name="$item['icon']" class="w-4 h-4"/>
                                                        </span>
                                                        <span class="text-sm font-medium text-navy/90 leading-tight pt-1.5">
                                                            {{ $locale === 'ms' ? $item['label_ms'] : $item['label_en'] }}
                                                            @if($item['external'] ?? false)<x-portal.icon name="arrow-top-right" class="w-3 h-3 inline text-navy/40 ml-0.5"/>@endif
                                                        </span>
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                            @if(isset($top['cta']))
                                <div class="col-span-2 -mx-8 -mb-8 mt-2 px-8 py-4 bg-navy/[0.03] border-t border-navy/5 rounded-b-2xl flex items-center justify-end">
                                    <a href="{{ $top['cta']['route'] }}" class="text-sm font-semibold text-gold-600 hover:text-gold inline-flex items-center gap-1">
                                        {{ $locale === 'ms' ? $top['cta']['label_ms'] : $top['cta']['label_en'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </nav>

            {{-- Mobile menu toggle --}}
            <button type="button" x-on:click="open = !open" class="lg:hidden p-2 rounded-md text-navy hover:bg-navy/10" aria-label="{{ __('Buka menu') }}">
                <x-portal.icon name="bars-3" class="w-6 h-6"/>
            </button>
        </div>

        {{-- Mobile drawer --}}
        <div x-show="open" x-transition class="lg:hidden border-t border-navy/10 py-4 space-y-4" x-cloak>
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-navy hover:bg-navy/5">{{ __('Utama') }}</a>
            @foreach($menu as $top)
                <details class="group">
                    <summary class="px-3 py-2 rounded-md text-sm font-semibold text-navy hover:bg-navy/5 cursor-pointer flex items-center justify-between">
                        {{ $locale === 'ms' ? $top['label_ms'] : $top['label_en'] }}
                        <svg class="w-4 h-4 transition group-open:rotate-180" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M1 1.5l5 5 5-5" stroke-linecap="round"/></svg>
                    </summary>
                    <div class="pl-3 mt-1 space-y-1">
                        @foreach($top['sections'] as $sec)
                            <div class="text-[10px] uppercase tracking-widest text-gold font-semibold px-3 mt-3">{{ $locale === 'ms' ? $sec['heading_ms'] : $sec['heading_en'] }}</div>
                            @foreach($sec['items'] as $item)
                                @if($item['soon'] ?? false)
                                    <div title="{{ __('Belum tersedia dalam prototaip ini') }}"
                                         class="flex items-center gap-2 px-3 py-2 rounded text-sm text-navy/40 cursor-help select-none">
                                        <x-portal.icon :name="$item['icon']" class="w-4 h-4 text-navy/30"/>
                                        <span class="line-through decoration-dashed">{{ $locale === 'ms' ? $item['label_ms'] : $item['label_en'] }}</span>
                                        <span class="ml-auto px-1.5 py-0.5 text-[9px] font-bold uppercase rounded bg-amber-100 text-amber-700">{{ __('Soon') }}</span>
                                    </div>
                                @else
                                    <a href="{{ $item['route'] }}" @if($item['external'] ?? false) target="_blank" rel="noopener" @endif
                                       class="flex items-center gap-2 px-3 py-2 rounded text-sm text-navy/70 hover:bg-navy/5">
                                        <x-portal.icon :name="$item['icon']" class="w-4 h-4 text-navy/40"/>
                                        {{ $locale === 'ms' ? $item['label_ms'] : $item['label_en'] }}
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </details>
            @endforeach
            <a href="{{ route('dashboard.statistik') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-navy hover:bg-navy/5">{{ __('Statistik') }}</a>

            <div class="mt-3 pt-3 border-t border-navy/10 grid grid-cols-2 gap-2">
                @foreach($pppa as $link)
                    <a href="{{ $link['route'] }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm text-navy/70 hover:bg-navy/5">
                        <x-portal.icon :name="$link['icon']" class="w-4 h-4"/>
                        {{ $locale === 'ms' ? $link['label_ms'] : $link['label_en'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>
