<div>
    <section class="relative overflow-hidden bg-navy text-white">
        <x-portal.hero-bg variant="waves" />
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
            <nav class="text-sm text-white/60 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">{{ __('Utama') }}</a>
                <span class="mx-2">›</span>
                <span class="text-white">{{ __('Direktori Cawangan') }}</span>
            </nav>
            <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Hubungi Kami') }}</span>
            <h1 class="mt-2 font-display text-4xl md:text-5xl font-bold">{{ __('Direktori JPPH') }}</h1>
            <p class="mt-3 text-white/70 max-w-2xl">{{ __('Cari pejabat JPPH di seluruh Malaysia. 24 lokasi termasuk Ibu Pejabat dan pejabat negeri.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        {{-- Search bar --}}
        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6 mb-8 grid md:grid-cols-3 gap-4">
            <div class="md:col-span-2 relative">
                <x-portal.icon name="magnifying-glass" class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-navy/50"/>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="{{ __('Cari nama, alamat atau negeri…') }}"
                       class="w-full pl-11 pr-4 py-3 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-navy">
            </div>
            <select wire:model.live="negeri"
                    class="px-4 py-3 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-navy">
                @foreach($negeriList as $n)
                    <option value="{{ $n }}">{{ $n === '' ? __('Semua negeri') : $n }}</option>
                @endforeach
            </select>
        </div>

        {{-- Counts --}}
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-navy/60">
                {{ __(':count cawangan dijumpai', ['count' => $cawangan->count()]) }}
                @if($search || $negeri)
                    <button wire:click="$set('search', ''); $set('negeri', '')" class="ml-2 text-gold-600 hover:text-gold underline">{{ __('Reset') }}</button>
                @endif
            </p>
        </div>

        {{-- Branch grid --}}
        @if($cawangan->isEmpty())
            <div class="bg-navy/5 rounded-xl p-12 text-center text-navy/60">{{ __('Tiada cawangan dijumpai. Cuba perkataan kunci lain.') }}</div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5" wire:key="branches-{{ $negeri }}-{{ $search }}">
                @foreach($cawangan as $i => $c)
                    <article class="group relative bg-white rounded-2xl ring-1 ring-navy/10 p-6 hover:ring-gold hover:shadow-xl hover:-translate-y-0.5 transition-all motion-safe:animate-fade-up overflow-hidden" style="animation-delay: {{ $i * 30 }}ms">
                        <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-gold/0 group-hover:bg-gold/10 blur-xl transition-all duration-500"></div>
                        <div class="relative flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide bg-gold/15 text-gold-600 rounded ring-1 ring-gold/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-gold-600"></span>
                                {{ $c['negeri'] }}
                            </span>
                            <span class="text-xs font-mono text-navy/30">#{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="relative mt-3 font-display font-bold text-navy text-lg leading-tight group-hover:text-navy">{{ $c['nama'] }}</h3>
                        <div class="relative mt-4 pt-4 border-t border-navy/5 space-y-2.5 text-sm text-navy/70">
                            <div class="flex items-start gap-2.5">
                                <x-portal.icon name="map" class="w-4 h-4 mt-0.5 shrink-0 text-gold-600"/>
                                <span class="leading-snug">{{ $c['alamat'] }}</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-portal.icon name="paper-airplane" class="w-4 h-4 text-gold-600"/>
                                <a href="tel:{{ str_replace([' ','-'], '', $c['tel']) }}" class="hover:text-gold transition">{{ $c['tel'] }}</a>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-portal.icon name="envelope" class="w-4 h-4 text-gold-600"/>
                                <span class="font-mono text-xs truncate">{{ $c['email'] }}</span>
                            </div>
                        </div>
                        <div class="relative mt-4 -mx-6 -mb-6 px-6 py-3 bg-navy/[0.02] flex items-center justify-between text-xs">
                            <span title="{{ __('Belum tersedia dalam prototaip ini') }}" class="cursor-help text-navy/40 inline-flex items-center gap-1">
                                <x-portal.icon name="lock-closed" class="w-3 h-3"/>
                                <span class="line-through decoration-dashed">{{ __('Lihat di peta') }}</span>
                            </span>
                            <a href="tel:{{ str_replace([' ','-'], '', $c['tel']) }}" class="font-semibold text-gold-600 hover:text-gold inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                                {{ __('Hubungi') }}
                                <x-portal.icon name="arrow-right" class="w-3 h-3"/>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</div>
