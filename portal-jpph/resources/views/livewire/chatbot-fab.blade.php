<div class="fixed bottom-6 right-6 z-40" x-data="{}" id="sembang">
    {{-- FAB --}}
    <button type="button" wire:click="toggle"
            x-show="!$wire.open"
            class="w-14 h-14 rounded-full bg-navy hover:bg-navy-700 text-gold shadow-2xl flex items-center justify-center group transition-transform hover:scale-105"
            aria-label="{{ __('Buka Sembang JPPH') }}">
        <x-portal.icon name="sparkles" class="w-6 h-6"/>
        <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute h-3 w-3 rounded-full bg-gold opacity-75"></span>
            <span class="relative rounded-full h-3 w-3 bg-gold"></span>
        </span>
    </button>

    {{-- Panel --}}
    <div x-show="$wire.open" x-transition.scale.origin.bottom.right
         class="w-[calc(100vw-3rem)] sm:w-96 h-[36rem] max-h-[calc(100vh-3rem)] bg-white rounded-2xl shadow-2xl ring-1 ring-navy/15 flex flex-col overflow-hidden"
         x-cloak>
        {{-- header --}}
        <div class="bg-navy text-white px-5 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gold/20 flex items-center justify-center">
                    <x-portal.icon name="sparkles" class="w-5 h-5 text-gold"/>
                </div>
                <div>
                    <div class="font-display font-bold leading-tight">{{ __('Sembang JPPH') }}</div>
                    <div class="text-[11px] text-white/60">{{ __('AI assistant — domain trained') }}</div>
                </div>
            </div>
            <button wire:click="toggle" class="p-1.5 rounded hover:bg-white/10" aria-label="{{ __('Tutup') }}">
                <x-portal.icon name="x-mark" class="w-5 h-5"/>
            </button>
        </div>

        {{-- messages --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-navy/[0.02]"
             x-data="{}"
             x-init="$nextTick(() => $el.scrollTop = $el.scrollHeight)"
             x-on:livewire-update.window="$nextTick(() => $el.scrollTop = $el.scrollHeight)">
            @foreach($messages as $msg)
                <div class="flex {{ $msg['who'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[85%] {{ $msg['who'] === 'user' ? 'bg-navy text-white rounded-tr-sm' : 'bg-white ring-1 ring-navy/10 text-navy rounded-tl-sm' }} rounded-2xl px-4 py-2.5 text-sm leading-relaxed">
                        {{ $msg['text'] }}
                        @if(($msg['who'] === 'bot') && !empty($msg['refs']))
                            <div class="mt-2 pt-2 border-t border-navy/10 text-xs text-navy/60">
                                <div class="font-semibold mb-1">{{ __('Soalan berkaitan:') }}</div>
                                <ul class="space-y-0.5">
                                    @foreach($msg['refs'] as $r)
                                        <li>· {{ $r }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            @if($thinking)
                <div class="flex justify-start">
                    <div class="bg-white ring-1 ring-navy/10 rounded-2xl rounded-tl-sm px-4 py-3">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-navy/40 rounded-full animate-bounce-dot" style="animation-delay:0s"></span>
                            <span class="w-2 h-2 bg-navy/40 rounded-full animate-bounce-dot" style="animation-delay:.2s"></span>
                            <span class="w-2 h-2 bg-navy/40 rounded-full animate-bounce-dot" style="animation-delay:.4s"></span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- suggestions --}}
        @if(count($messages) <= 1)
            <div class="px-4 py-2 border-t border-navy/5 bg-navy/[0.02]">
                <div class="text-[10px] uppercase tracking-wide text-navy/50 mb-1.5">{{ __('Cuba tanya:') }}</div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach([
                        __('Berapa duti setem rumah RM500k?'),
                        __('Berapa lama penilaian pinjaman?'),
                        __('Hubungi cawangan terdekat'),
                        __('Apa itu tukar syarat tanah?'),
                    ] as $s)
                        <button wire:click="setSuggestion('{{ $s }}')"
                                class="text-xs px-2.5 py-1.5 rounded-full bg-white ring-1 ring-navy/10 text-navy/70 hover:ring-gold hover:text-navy transition">
                            {{ $s }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- input --}}
        <form wire:submit="send" class="p-3 border-t border-navy/10 flex gap-2 bg-white">
            <input type="text" wire:model="input"
                   placeholder="{{ __('Tanya soalan anda...') }}"
                   class="flex-1 px-4 py-2.5 rounded-lg border border-navy/15 focus:ring-2 focus:ring-gold focus:border-gold text-sm">
            <button type="submit"
                    class="w-10 h-10 rounded-lg bg-navy hover:bg-navy-700 text-gold flex items-center justify-center transition"
                    aria-label="{{ __('Hantar') }}">
                <x-portal.icon name="paper-airplane" class="w-5 h-5"/>
            </button>
        </form>
    </div>
</div>
