@php $locale = app()->getLocale(); @endphp
<div>
    <section class="relative overflow-hidden bg-navy text-white">
        <x-portal.hero-bg variant="waves" />
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
            <nav class="text-sm text-white/60 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">{{ __('Utama') }}</a>
                <span class="mx-2">›</span>
                <span class="text-white">{{ __('Profil Jabatan') }}</span>
            </nav>
            <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Mengenai JPPH') }}</span>
            <h1 class="mt-2 font-display text-4xl md:text-5xl font-bold">{{ __('Profil Jabatan') }}</h1>
            <p class="mt-3 text-white/70 max-w-2xl">{{ __('Kenali Jabatan Penilaian dan Perkhidmatan Harta — peneraju penilaian harta tanah di Malaysia sejak 1956.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($pages as $i => $page)
                <a href="{{ route('page.show', $page->slug) }}"
                   class="group relative bg-white rounded-2xl ring-1 ring-navy/10 p-6 hover:ring-gold hover:-translate-y-1 hover:shadow-xl transition-all duration-300 motion-safe:animate-fade-up overflow-hidden"
                   style="animation-delay: {{ $i * 50 }}ms">
                    {{-- decorative gold glow on hover --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-gold/0 group-hover:bg-gold/10 blur-2xl transition-all duration-500"></div>
                    <div class="relative flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-navy/5 to-navy/[0.02] text-navy flex items-center justify-center shrink-0 group-hover:from-gold/15 group-hover:to-gold/5 group-hover:text-gold-600 group-hover:scale-105 transition-all">
                            <x-portal.icon :name="$iconMap[$page->slug] ?? 'document-text'" class="w-6 h-6"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-xs uppercase tracking-wide text-navy/40 font-mono">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="font-display font-bold text-navy text-lg leading-tight mt-1 group-hover:text-navy">
                                {{ $page->title($locale) }}
                            </h3>
                        </div>
                    </div>
                    <div class="relative mt-5 pt-4 border-t border-navy/5 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1 text-sm font-semibold text-gold-600 group-hover:gap-2 transition-all">
                            {{ __('Baca lanjut') }}
                            <x-portal.icon name="arrow-right" class="w-3.5 h-3.5"/>
                        </span>
                        <span class="text-[10px] uppercase tracking-widest text-navy/30">{{ __('Profil') }}</span>
                    </div>
                </a>
            @endforeach

            {{-- Coming soon tile: Sejarah Penilaian --}}
            <x-portal.coming-soon-link
                icon="academic-cap"
                :label="__('Sejarah Penilaian Malaysia')"
                variant="tile" />
        </div>
    </section>
</div>
