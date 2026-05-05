@php $p = $this->pengiraan; @endphp
<div>
    <section class="bg-navy text-white">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-12">
            <nav class="text-sm text-white/60 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">{{ __('Utama') }}</a>
                <span class="mx-2">›</span>
                <span>{{ __('Microsite') }}</span>
                <span class="mx-2">›</span>
                <span class="text-white">{{ __('Pengiraan Duti Setem') }}</span>
            </nav>
            <h1 class="font-display text-3xl md:text-4xl font-bold">{{ __('Pengiraan Duti Setem') }}</h1>
            <p class="mt-2 text-white/70 max-w-2xl">{{ __('Anggaran duti setem untuk pemindahmilikan harta tanah berdasarkan Akta Setem 1949 (Jadual Pertama, Item 32).') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 -mt-8 pb-24 relative z-10">
        <div class="grid lg:grid-cols-5 gap-6">
            {{-- Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl ring-1 ring-navy/10 p-6 sm:p-8 sticky top-32">
                    <h2 class="font-display font-bold text-xl text-navy mb-1">{{ __('Maklumat Hartanah') }}</h2>
                    <p class="text-sm text-navy/60 mb-5">{{ __('Pengiraan dikemaskini secara langsung.') }}</p>

                    <label class="block">
                        <span class="block text-sm font-semibold text-navy mb-2">{{ __('Nilai Hartanah (RM)') }}</span>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-navy/50 font-semibold">RM</span>
                            <input type="number" wire:model.live.debounce.300ms="nilaiHartanah" min="0" step="1000"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-navy text-lg font-semibold">
                        </div>
                    </label>

                    <div class="mt-3 grid grid-cols-3 gap-2">
                        @foreach([300_000, 500_000, 750_000, 1_000_000, 1_500_000, 2_500_000] as $ex)
                            <button type="button" wire:click="setExample({{ $ex }})"
                                    class="px-2 py-1.5 text-xs rounded-md bg-navy/5 hover:bg-gold/15 hover:text-gold-600 text-navy/70 transition">
                                RM {{ $ex >= 1_000_000 ? number_format($ex / 1_000_000, 1) . 'jt' : number_format($ex / 1000) . 'k' }}
                            </button>
                        @endforeach
                    </div>

                    <label class="block mt-5">
                        <span class="block text-sm font-semibold text-navy mb-2">{{ __('Jenis Pindahmilik') }}</span>
                        <select wire:model.live="jenis"
                                class="w-full px-4 py-3 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-navy">
                            <option value="jual_beli">{{ __('Jual Beli') }}</option>
                            <option value="hadiah">{{ __('Hadiah / Pemberian') }}</option>
                            <option value="pewarisan">{{ __('Pewarisan') }}</option>
                            <option value="lain">{{ __('Lain-lain') }}</option>
                        </select>
                    </label>

                    <label class="flex items-center gap-3 mt-5 cursor-pointer">
                        <input type="checkbox" wire:model.live="isWargaAsing"
                               class="w-4 h-4 rounded border-navy/20 text-navy focus:ring-gold">
                        <span class="text-sm text-navy">{{ __('Pemohon adalah warganegara asing') }}</span>
                    </label>
                    <p class="mt-1 text-xs text-navy/50 ml-7">{{ __('Pindaan Akta Setem berkuatkuasa 1 Jan 2024 — kadar rata 4%.') }}</p>
                </div>
            </div>

            {{-- Result --}}
            <div class="lg:col-span-3">
                <div class="bg-gradient-to-br from-navy to-navy-800 text-white rounded-2xl shadow-xl p-6 sm:p-8">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div>
                            <div class="text-xs uppercase tracking-widest text-gold">{{ __('Anggaran Duti Setem') }}</div>
                            <div class="font-display text-5xl font-extrabold mt-1">
                                RM {{ number_format($p['total'], 2) }}
                            </div>
                            <div class="mt-2 text-sm text-white/70">
                                {{ __('Untuk hartanah bernilai') }} <strong class="text-white">RM {{ number_format($p['value'], 2) }}</strong>
                                @if($p['effective_rate'] > 0)
                                    · {{ __('kadar berkesan') }} <strong class="text-gold">{{ number_format($p['effective_rate'], 2) }}%</strong>
                                @endif
                            </div>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-gold/15 flex items-center justify-center text-gold">
                            <x-portal.icon name="calculator" class="w-9 h-9"/>
                        </div>
                    </div>
                </div>

                @if(!empty($p['rows']))
                    <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 overflow-hidden mt-4">
                        <div class="px-6 sm:px-8 py-4 bg-navy/5 border-b border-navy/5">
                            <h3 class="font-display font-bold text-navy">{{ __('Pecahan Pengiraan (Slab Progresif)') }}</h3>
                        </div>
                        <table class="w-full text-sm">
                            <thead class="bg-navy/5 text-xs uppercase tracking-wide text-navy/60">
                                <tr>
                                    <th class="px-6 sm:px-8 py-3 text-left">{{ __('Bracket') }}</th>
                                    <th class="px-4 py-3 text-right">{{ __('Bercukai') }}</th>
                                    <th class="px-4 py-3 text-right">{{ __('Kadar') }}</th>
                                    <th class="px-6 sm:px-8 py-3 text-right">{{ __('Duti Setem') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-navy/5">
                                @foreach($p['rows'] as $row)
                                    <tr class="hover:bg-navy/3">
                                        <td class="px-6 sm:px-8 py-3 text-navy">{{ $row['range'] }}</td>
                                        <td class="px-4 py-3 text-right text-navy">RM {{ number_format($row['taxable'], 2) }}</td>
                                        <td class="px-4 py-3 text-right text-navy">{{ number_format($row['rate'] * 100, 1) }}%</td>
                                        <td class="px-6 sm:px-8 py-3 text-right font-semibold text-navy">RM {{ number_format($row['tax'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gold/10">
                                <tr>
                                    <td colspan="3" class="px-6 sm:px-8 py-3 text-right text-navy font-semibold">{{ __('Jumlah') }}</td>
                                    <td class="px-6 sm:px-8 py-3 text-right text-navy font-bold text-lg">RM {{ number_format($p['total'], 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif

                <div class="mt-4 p-5 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-900">
                    <strong class="font-semibold">{{ __('Penafian:') }}</strong>
                    {{ __('Pengiraan ini adalah anggaran berdasarkan Akta Setem 1949, Jadual Pertama Item 32. Jumlah sebenar tertakluk kepada penilaian rasmi LHDN dan JPPH. Sila rujuk pegawai kami untuk pengesahan.') }}
                </div>
            </div>
        </div>
    </section>
</div>
