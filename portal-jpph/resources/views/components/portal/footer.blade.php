@php
    $locale = app()->getLocale();
@endphp
<footer class="mt-24 bg-navy text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <img src="/images/jpph-logo.png" alt="{{ __('Logo JPPH') }}" class="h-12 w-12 object-contain bg-white rounded p-1">
                <div>
                    <div class="text-[10px] uppercase tracking-widest text-white/60">{{ __('Laman Web Rasmi') }}</div>
                    <div class="font-display font-bold leading-tight">JPPH</div>
                </div>
            </div>
            <p class="text-sm text-white/70 leading-relaxed">{{ __('Jabatan Penilaian dan Perkhidmatan Harta. Perkhidmatan Bernilai, Komitmen Kami.') }}</p>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gold mb-3 uppercase tracking-wide">{{ __('Profil') }}</h3>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="{{ route('page.show', 'latar-belakang') }}" class="hover:text-gold">{{ __('Latar Belakang') }}</a></li>
                <li><a href="{{ route('page.show', 'visi-misi-objektif') }}" class="hover:text-gold">{{ __('Visi, Misi & Objektif') }}</a></li>
                <li><a href="{{ route('page.show', 'hubungi-kami') }}" class="hover:text-gold">{{ __('Hubungi Kami') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gold mb-3 uppercase tracking-wide">{{ __('Perkhidmatan') }}</h3>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="{{ route('microsite.duti-setem') }}" class="hover:text-gold">{{ __('Status Kes Duti Setem') }}</a></li>
                <li><a href="{{ route('microsite.pinjaman') }}" class="hover:text-gold">{{ __('Status Kes Pinjaman Perumahan') }}</a></li>
                <li><a href="{{ route('microsite.calc-duti') }}" class="hover:text-gold">{{ __('Pengiraan Duti Setem') }}</a></li>
                <li><a href="{{ route('dashboard.statistik') }}" class="hover:text-gold">{{ __('Dashboard Statistik') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gold mb-3 uppercase tracking-wide">{{ __('Pautan Luar') }}</h3>
            <ul class="space-y-2 text-sm text-white/80">
                <li>
                    <a href="https://www.malaysia.gov.my" target="_blank" rel="noopener" class="hover:text-gold inline-flex items-center gap-1">
                        MyGovernment <x-portal.icon name="arrow-top-right" class="w-3 h-3" />
                    </a>
                </li>
                <li>
                    <a href="https://data.gov.my" target="_blank" rel="noopener" class="hover:text-gold inline-flex items-center gap-1">
                        {{ __('Data Terbuka Sektor Awam') }} <x-portal.icon name="arrow-top-right" class="w-3 h-3" />
                    </a>
                </li>
                <li>
                    <a href="https://napic.jpph.gov.my" target="_blank" rel="noopener" class="hover:text-gold inline-flex items-center gap-1">
                        NAPIC <x-portal.icon name="arrow-top-right" class="w-3 h-3" />
                    </a>
                </li>
                <li>
                    <a href="https://www.hasil.gov.my" target="_blank" rel="noopener" class="hover:text-gold inline-flex items-center gap-1">
                        LHDN <x-portal.icon name="arrow-top-right" class="w-3 h-3" />
                    </a>
                </li>
                <li>
                    <span title="{{ __('Belum tersedia dalam prototaip ini') }}" class="cursor-help inline-flex items-center gap-1 text-white/40">
                        <span class="line-through decoration-dashed">{{ __('ePerolehan JPPH') }}</span>
                        <x-portal.icon name="lock-closed" class="w-3 h-3" />
                    </span>
                </li>
            </ul>

            {{-- MyJPPH intranet card --}}
            <a href="{{ route('login') }}"
               class="mt-6 group flex items-center gap-3 p-3 rounded-xl bg-gradient-to-br from-gold/15 to-gold/5 ring-1 ring-gold/30 hover:ring-gold transition">
                <div class="w-10 h-10 rounded-lg bg-gold text-navy flex items-center justify-center shrink-0 group-hover:scale-105 transition">
                    <x-portal.icon name="building-library" class="w-5 h-5"/>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs uppercase tracking-wide text-gold/80">MyJPPH</div>
                    <div class="text-sm font-semibold text-white">{{ __('Portal Intranet Warga') }}</div>
                </div>
                <x-portal.icon name="arrow-right" class="w-4 h-4 text-white/60 group-hover:text-gold group-hover:translate-x-0.5 transition"/>
            </a>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-white/60">
            <div class="flex items-center gap-3">
                <img src="/images/jata-negara.png" alt="{{ __('Jata Negara Malaysia') }}" class="h-10 object-contain">
                <span>&copy; {{ date('Y') }} {{ __('Jabatan Penilaian dan Perkhidmatan Harta. Hak Cipta Terpelihara.') }}</span>
            </div>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                <a href="{{ route('page.show', 'dasar-privasi') }}" class="hover:text-gold">{{ __('Dasar Privasi') }}</a>
                <a href="{{ route('page.show', 'dasar-keselamatan') }}" class="hover:text-gold">{{ __('Dasar Keselamatan') }}</a>
                <span>{{ __('Pematuhan PPPA Bil.1/2025') }}</span>
            </div>
        </div>
    </div>
</footer>
