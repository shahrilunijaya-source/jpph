@php
    $statusTimeline = ['diterima', 'dalam_semakan', 'menunggu_dokumen', 'diluluskan'];
    $statusLabels = [
        'diterima' => __('Diterima'),
        'dalam_semakan' => __('Dalam Semakan'),
        'menunggu_dokumen' => __('Menunggu Dokumen'),
        'diluluskan' => __('Diluluskan'),
        'ditolak' => __('Ditolak'),
    ];
    $statusColors = [
        'diterima' => 'bg-blue-100 text-blue-700',
        'dalam_semakan' => 'bg-amber-100 text-amber-700',
        'menunggu_dokumen' => 'bg-amber-100 text-amber-700',
        'diluluskan' => 'bg-green-100 text-green-700',
        'ditolak' => 'bg-red-100 text-red-700',
    ];
@endphp
<div>
    {{-- Compact hero --}}
    <section class="bg-navy text-white">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-12">
            <nav class="text-sm text-white/60 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">{{ __('Utama') }}</a>
                <span class="mx-2">›</span>
                <span>{{ __('Microsite') }}</span>
                <span class="mx-2">›</span>
                <span class="text-white">{{ __('Status Kes Duti Setem') }}</span>
            </nav>
            <h1 class="font-display text-3xl md:text-4xl font-bold">{{ __('Status Kes Duti Setem') }}</h1>
            <p class="mt-2 text-white/70 max-w-2xl">{{ __('Masukkan nombor rujukan kes anda untuk semakan status terkini.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 -mt-8 pb-24 relative z-10">
        {{-- Lookup form --}}
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-navy/10 p-6 sm:p-8">
            <form wire:submit="lookup" class="space-y-4">
                <label for="ref" class="block">
                    <span class="block text-sm font-semibold text-navy mb-2">{{ __('Nombor Rujukan') }}</span>
                    <div class="relative">
                        <x-portal.icon name="magnifying-glass" class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-navy/50"/>
                        <input id="ref" type="text" wire:model="reference"
                               placeholder="JPPH/DS/2026/00123"
                               class="w-full pl-11 pr-4 py-3.5 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-navy uppercase placeholder:normal-case placeholder-navy/30">
                    </div>
                    <p class="mt-1.5 text-xs text-navy/50">{{ __('Format: JPPH/DS/YYYY/NNNNN') }}</p>
                </label>
                <div class="flex gap-2">
                    <button type="submit"
                            class="px-6 py-3 bg-navy text-white rounded-lg font-semibold hover:bg-navy-800 transition flex items-center gap-2"
                            wire:loading.attr="disabled" wire:loading.class="opacity-70">
                        <span wire:loading.remove wire:target="lookup">{{ __('Semak Status') }}</span>
                        <span wire:loading wire:target="lookup">{{ __('Memuatkan...') }}</span>
                        <x-portal.icon name="arrow-right" class="w-4 h-4"/>
                    </button>
                    @if($searched)
                        <button type="button" wire:click="clearForm"
                                class="px-4 py-3 bg-navy/5 text-navy rounded-lg font-semibold hover:bg-navy/10 transition">
                            {{ __('Reset') }}
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Result / error --}}
        @if($searched)
            <div class="mt-6 motion-safe:animate-fade-up">
                @if($error)
                    <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl p-6 flex items-start gap-3">
                        <x-portal.icon name="x-mark" class="w-5 h-5 mt-0.5 shrink-0"/>
                        <div>
                            <strong class="font-semibold block">{{ __('Tiada Rekod') }}</strong>
                            <p class="text-sm mt-1">{{ $error }}</p>
                            <p class="text-sm mt-2 text-red-700">{{ __('Cuba: JPPH/DS/2026/00123 (rujukan demo).') }}</p>
                        </div>
                    </div>
                @elseif($result)
                    <article class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 overflow-hidden">
                        <div class="p-6 sm:p-8 border-b border-navy/5">
                            <div class="flex items-start justify-between flex-wrap gap-3">
                                <div>
                                    <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Nombor Rujukan') }}</div>
                                    <div class="font-mono text-lg font-bold text-navy mt-0.5">{{ $result->no_rujukan }}</div>
                                </div>
                                <span class="px-3 py-1.5 rounded-full text-sm font-semibold {{ $statusColors[$result->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $statusLabels[$result->status] ?? $result->status }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8 grid sm:grid-cols-2 gap-6">
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Pemohon') }}</div>
                                <div class="font-semibold text-navy mt-0.5">{{ $result->pemohon_nama }}</div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('No. KP (Bertopeng)') }}</div>
                                <div class="font-mono text-navy/80 mt-0.5">{{ $result->masked_ic }}</div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Jenis Pindahmilik') }}</div>
                                <div class="text-navy mt-0.5 capitalize">{{ str_replace('_', ' ', $result->jenis_pindahmilik) }}</div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Nilai Hartanah') }}</div>
                                <div class="font-semibold text-navy mt-0.5">RM {{ number_format($result->nilai_hartanah_rm, 2) }}</div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Cawangan') }}</div>
                                <div class="text-navy mt-0.5">{{ $result->cawangan }}</div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Pegawai Penilai') }}</div>
                                <div class="text-navy mt-0.5">{{ $result->pegawai_penilai }}</div>
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="p-6 sm:p-8 bg-navy/5 border-t border-navy/5">
                            <div class="text-xs uppercase tracking-wide text-navy/50 mb-4">{{ __('Aliran Status') }}</div>
                            <ol class="flex flex-wrap items-center gap-2 text-sm">
                                @php
                                    $currentIdx = array_search($result->status, $statusTimeline);
                                    if ($currentIdx === false) $currentIdx = -1;
                                @endphp
                                @foreach($statusTimeline as $i => $st)
                                    @php $reached = $i <= $currentIdx; @endphp
                                    <li class="flex items-center gap-2">
                                        <span class="w-7 h-7 rounded-full flex items-center justify-center
                                            {{ $reached ? 'bg-green-500 text-white' : 'bg-navy/10 text-navy/40' }}">
                                            @if($reached)
                                                <x-portal.icon name="check-circle" class="w-4 h-4"/>
                                            @else
                                                <span>{{ $i + 1 }}</span>
                                            @endif
                                        </span>
                                        <span class="{{ $reached ? 'text-navy font-medium' : 'text-navy/40' }}">
                                            {{ $statusLabels[$st] }}
                                        </span>
                                        @if(!$loop->last)
                                            <span class="text-navy/20 mx-1">›</span>
                                        @endif
                                    </li>
                                @endforeach
                                @if($result->status === 'ditolak')
                                    <li class="flex items-center gap-2 ml-2">
                                        <span class="w-7 h-7 rounded-full bg-red-500 text-white flex items-center justify-center">
                                            <x-portal.icon name="x-mark" class="w-4 h-4"/>
                                        </span>
                                        <span class="text-red-700 font-medium">{{ __('Ditolak') }}</span>
                                    </li>
                                @endif
                            </ol>
                            <div class="mt-4 flex items-center gap-2 text-xs text-navy/60">
                                <x-portal.icon name="clock" class="w-3.5 h-3.5"/>
                                {{ __('Tarikh terima:') }} {{ $result->tarikh_terima->isoFormat('D MMM YYYY') }}
                                ·
                                {{ __('Dikemaskini:') }} {{ $result->tarikh_kemaskini->isoFormat('D MMM YYYY') }}
                            </div>
                            @if($result->catatan)
                                <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded text-sm text-amber-900">
                                    <strong class="font-semibold">{{ __('Catatan:') }}</strong> {{ $result->catatan }}
                                </div>
                            @endif
                        </div>
                    </article>
                @endif
            </div>
        @else
            <div class="mt-6 grid sm:grid-cols-3 gap-3 text-sm">
                @foreach(['diluluskan','dalam_semakan','menunggu_dokumen'] as $exampleStatus)
                    @php
                        $sample = \App\Models\CaseDutiSetem::where('status', $exampleStatus)->first();
                    @endphp
                    @if($sample)
                        <button type="button" wire:click="$set('reference', '{{ $sample->no_rujukan }}')"
                                class="text-left p-4 bg-white rounded-xl ring-1 ring-navy/10 hover:ring-gold hover:shadow transition">
                            <div class="text-xs uppercase tracking-wide text-navy/50">{{ __('Cuba demo:') }}</div>
                            <div class="font-mono text-navy font-semibold mt-1">{{ $sample->no_rujukan }}</div>
                            <div class="text-xs text-navy/60 mt-1">Status: {{ $statusLabels[$exampleStatus] }}</div>
                        </button>
                    @endif
                @endforeach
            </div>
        @endif
    </section>
</div>
