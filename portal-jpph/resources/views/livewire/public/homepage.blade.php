@php
    $locale = app()->getLocale();
    $audiences = [
        ['key' => 'rakyat', 'ms' => 'Rakyat', 'en' => 'Citizens'],
        ['key' => 'profesional', 'ms' => 'Profesional', 'en' => 'Professionals'],
        ['key' => 'warga', 'ms' => 'Warga JPPH', 'en' => 'JPPH Staff'],
        ['key' => 'penyelidik', 'ms' => 'Penyelidik', 'en' => 'Researchers'],
    ];
@endphp
<div>
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-navy text-white">
        {{-- gradient mesh + noise overlay --}}
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute -top-40 -right-40 w-[40rem] h-[40rem] rounded-full bg-gold/10 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-[40rem] h-[40rem] rounded-full bg-blue-500/10 blur-3xl"></div>
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 pb-28 grid lg:grid-cols-2 gap-12 items-center">
            <div class="motion-safe:animate-fade-up">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-gold/15 text-gold text-xs font-semibold uppercase tracking-widest rounded-full">
                    <x-portal.icon name="sparkles" class="w-3.5 h-3.5"/>
                    {{ __('Portal Rasmi JPPH 2026') }}
                </span>
                <h1 class="mt-5 font-display text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-[1.05] tracking-tight">
                    {{ __('Perkhidmatan Bernilai,') }}<br>
                    <span class="text-gold">{{ __('Komitmen Kami.') }}</span>
                </h1>
                <p class="mt-6 text-lg text-white/80 max-w-xl">
                    {{ __('Jabatan Penilaian dan Perkhidmatan Harta — peneraju penilaian harta tanah dan harta alih di Malaysia. Semak status kes anda, hitung duti setem, dan akses perkhidmatan dalam talian dengan pantas.') }}
                </p>

                {{-- Quick search bar --}}
                <form action="{{ route('microsite.duti-setem') }}" method="get" class="mt-8 flex flex-col sm:flex-row gap-2 max-w-lg">
                    <div class="flex-1 relative">
                        <x-portal.icon name="magnifying-glass" class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-navy/50"/>
                        <input type="text" name="ref" placeholder="{{ __('Contoh: JPPH/DS/2026/00123') }}"
                               class="w-full pl-11 pr-4 py-3.5 rounded-lg bg-white text-navy placeholder-navy/40 focus:ring-2 focus:ring-gold focus:outline-none">
                    </div>
                    <button type="submit"
                            class="px-6 py-3.5 bg-gold hover:bg-gold-400 text-navy font-semibold rounded-lg transition flex items-center justify-center gap-2">
                        {{ __('Semak Status') }}
                        <x-portal.icon name="arrow-right" class="w-4 h-4"/>
                    </button>
                </form>
                <p class="mt-2 text-xs text-white/50">{{ __('Format rujukan: JPPH/DS/YYYY/NNNNN (duti setem) atau JPPH/PP/YYYY/NNNNN (pinjaman)') }}</p>
            </div>

            {{-- Floating live stats card --}}
            <div class="relative motion-safe:animate-fade-up [animation-delay:200ms]" x-data="{ tilt: { x: 0, y: 0 } }"
                 x-on:mousemove="tilt.x = ($event.offsetX / $el.offsetWidth - 0.5) * 4; tilt.y = ($event.offsetY / $el.offsetHeight - 0.5) * -4"
                 x-on:mouseleave="tilt.x = 0; tilt.y = 0">
                <div class="bg-white text-navy rounded-2xl shadow-2xl p-8 transition-transform duration-300"
                     :style="`transform: perspective(1000px) rotateY(${tilt.x}deg) rotateX(${tilt.y}deg)`">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-navy/60 uppercase tracking-wide">{{ __('Statistik Hari Ini') }}</div>
                            <div class="text-xl font-display font-bold mt-1">{{ __('Live Database') }}</div>
                        </div>
                        <span class="flex h-3 w-3" aria-hidden="true">
                            <span class="animate-ping absolute h-3 w-3 rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                    </div>

                    <dl class="mt-6 grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs text-navy/60">{{ __('Kes Diluluskan') }}</dt>
                            <dd class="text-3xl font-display font-bold text-navy">{{ number_format($kpi['kes_diluluskan']) }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navy/60">{{ __('Jumlah Kes') }}</dt>
                            <dd class="text-3xl font-display font-bold text-navy">{{ number_format($kpi['jumlah_kes']) }}</dd>
                        </div>
                        <div class="col-span-2">
                            <dt class="text-xs text-navy/60">{{ __('Nilai Hartanah Dinilai') }}</dt>
                            <dd class="text-2xl font-display font-bold text-gold-600">RM {{ number_format($kpi['nilai_dinilai_rm'] / 1_000_000, 2) }}<span class="text-base text-navy/60 font-normal"> {{ __('juta') }}</span></dd>
                        </div>
                    </dl>

                    <div class="mt-6 pt-4 border-t border-navy/10 flex items-center justify-between text-xs text-navy/60">
                        <span class="inline-flex items-center gap-1">
                            <x-portal.icon name="clock" class="w-3.5 h-3.5"/>
                            {{ __('Dikemas kini :timestamp', ['timestamp' => now()->isoFormat('D MMM YYYY, H:mm')]) }}
                        </span>
                        <a href="{{ route('dashboard.statistik') }}" class="text-navy hover:text-gold-600 font-semibold inline-flex items-center gap-0.5">
                            {{ __('Lebih lanjut') }}
                            <x-portal.icon name="arrow-right" class="w-3 h-3"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- AUDIENCE SWITCHER --}}
    <section class="relative -mt-12 z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-navy/5 p-2 inline-flex flex-wrap gap-1">
            @foreach($audiences as $a)
                <button type="button" wire:click="setAudience('{{ $a['key'] }}')"
                        class="px-5 py-2.5 rounded-xl text-sm font-medium transition
                               {{ $audience === $a['key'] ? 'bg-navy text-white shadow-md' : 'text-navy/70 hover:bg-navy/5' }}">
                    {{ $locale === 'ms' ? $a['ms'] : $a['en'] }}
                </button>
            @endforeach
        </div>
        <p class="mt-3 text-sm text-navy/60">{{ __('Maklumat dan perkhidmatan disusun mengikut kumpulan sasaran pengguna anda.') }}</p>
    </section>

    {{-- MICROSITE TILES --}}
    <section id="microsite" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Perkhidmatan Pantas') }}</span>
                <h2 class="mt-1 text-3xl md:text-4xl font-display font-bold text-navy">{{ __('Apa yang anda perlukan?') }}</h2>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" wire:key="tiles-{{ $audience }}">
            @foreach($microsites as $tile)
                <a href="{{ $tile['route'] }}" @if(($tile['external'] ?? false)) target="_blank" rel="noopener" @endif
                   class="group relative bg-white rounded-2xl ring-1 ring-navy/10 p-6 hover:ring-gold hover:-translate-y-1 hover:shadow-xl transition-all duration-300 motion-safe:animate-fade-up overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full bg-gold/0 group-hover:bg-gold/10 blur-2xl transition-all duration-500"></div>
                    <div class="relative w-12 h-12 rounded-xl bg-gradient-to-br from-navy/5 to-navy/[0.02] text-navy flex items-center justify-center mb-4 group-hover:from-gold/15 group-hover:to-gold/5 group-hover:text-gold-600 group-hover:scale-105 transition-all">
                        <x-portal.icon :name="$tile['icon']" class="w-6 h-6"/>
                    </div>
                    <h3 class="relative font-display font-bold text-navy text-lg leading-tight">
                        {{ $locale === 'ms' ? $tile['title_ms'] : $tile['title_en'] }}
                    </h3>
                    <p class="relative mt-1.5 text-sm text-navy/60">{{ $locale === 'ms' ? $tile['desc_ms'] : $tile['desc_en'] }}</p>
                    <div class="relative mt-4 inline-flex items-center gap-1 text-sm font-semibold text-gold-600 group-hover:gap-2 transition-all">
                        {{ __('Buka') }}
                        <x-portal.icon name="arrow-right" class="w-3.5 h-3.5"/>
                    </div>
                    @if(($tile['external'] ?? false))
                        <span class="absolute top-4 right-4 text-navy/30 group-hover:text-gold-600 transition">
                            <x-portal.icon name="arrow-top-right" class="w-4 h-4"/>
                        </span>
                    @endif
                </a>
            @endforeach

            {{-- Coming-soon tile --}}
            <x-portal.coming-soon-link
                icon="flag"
                :label="__('ePerolehan JPPH')"
                variant="tile" />
        </div>
    </section>

    {{-- ANNOUNCEMENTS --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-24">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Hebahan Terkini') }}</span>
                <h2 class="mt-1 text-3xl md:text-4xl font-display font-bold text-navy">{{ __('Maklumat Terkini') }}</h2>
            </div>
            <span class="hidden sm:flex items-center gap-2 text-sm text-navy/60">
                <span class="flex h-2 w-2 rounded-full bg-green-500"></span>
                {{ __('Kemaskini langsung') }}
            </span>
        </div>

        @if($announcements->isEmpty())
            <div class="bg-navy/5 rounded-xl p-8 text-center text-navy/60">{{ __('Tiada Makluman Terkini') }}</div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5" x-data="{ idx: 0 }">
                @foreach($announcements as $i => $a)
                    <article class="bg-white rounded-2xl ring-1 ring-navy/10 overflow-hidden hover:shadow-lg transition motion-safe:animate-fade-up">
                        <div class="p-6">
                            <time datetime="{{ $a->published_at->toIso8601String() }}" class="text-xs text-navy/50 uppercase tracking-wide">
                                {{ $a->published_at->isoFormat('D MMM YYYY') }}
                            </time>
                            <h3 class="mt-2 font-display font-bold text-navy text-lg leading-tight">
                                {{ $a->title($locale) }}
                            </h3>
                            <p class="mt-2 text-sm text-navy/70 line-clamp-3">{{ $a->excerpt($locale) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- TRUST/COMPLIANCE STRIP --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-24">
        <div class="bg-navy text-white rounded-2xl p-10 md:p-14 grid md:grid-cols-3 gap-8 relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-gold/10 blur-2xl pointer-events-none"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-gold/15 rounded-xl flex items-center justify-center text-gold mb-3">
                    <x-portal.icon name="check-circle" class="w-7 h-7"/>
                </div>
                <h3 class="font-display font-bold text-xl">{{ __('Pematuhan PPPA Bil.1/2025') }}</h3>
                <p class="mt-2 text-sm text-white/70">{{ __('Memenuhi semua keperluan Pekeliling Pendigitalan Perkhidmatan Awam Bilangan 1 Tahun 2025.') }}</p>
            </div>
            <div class="relative">
                <div class="w-12 h-12 bg-gold/15 rounded-xl flex items-center justify-center text-gold mb-3">
                    <x-portal.icon name="eye" class="w-7 h-7"/>
                </div>
                <h3 class="font-display font-bold text-xl">{{ __('Aksesibiliti OKU') }}</h3>
                <p class="mt-2 text-sm text-white/70">{{ __('WCAG AA compliance dengan mod kontras tinggi untuk pengguna OKU. Aktifkan pada bar atas.') }}</p>
            </div>
            <div class="relative">
                <div class="w-12 h-12 bg-gold/15 rounded-xl flex items-center justify-center text-gold mb-3">
                    <x-portal.icon name="users" class="w-7 h-7"/>
                </div>
                <h3 class="font-display font-bold text-xl">{{ __('2 Bahasa') }}</h3>
                <p class="mt-2 text-sm text-white/70">{{ __('Bahasa Malaysia (utama) dan English. Tukar pada bar atas pada bila-bila masa.') }}</p>
            </div>
        </div>
    </section>
</div>
