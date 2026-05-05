@props([
    'icon' => null,
    'label' => '',
    'variant' => 'menu', // menu | inline | tile
    'tooltip' => null,
])
@php
    $tooltip = $tooltip ?? __('Belum tersedia dalam prototaip ini');
@endphp

@if($variant === 'tile')
    <div role="button" aria-disabled="true" tabindex="0" title="{{ $tooltip }}"
         x-data="{ tip: false }" x-on:mouseenter="tip = true" x-on:mouseleave="tip = false" x-on:focus="tip = true" x-on:blur="tip = false"
         class="relative cursor-help select-none bg-white/70 rounded-2xl ring-1 ring-dashed ring-navy/15 p-6 opacity-60 hover:opacity-80 transition motion-safe:animate-fade-up">
        @if($icon)
            <div class="w-11 h-11 rounded-xl bg-navy/5 text-navy/50 flex items-center justify-center mb-4 relative">
                <x-portal.icon :name="$icon" class="w-6 h-6"/>
                <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-amber-100 text-amber-700 ring-1 ring-amber-300 flex items-center justify-center">
                    <x-portal.icon name="lock-closed" class="w-3 h-3"/>
                </span>
            </div>
        @endif
        <h3 class="font-display font-bold text-navy/70 text-lg leading-tight">
            {{ $label }}
        </h3>
        <p class="mt-1.5 text-sm text-navy/50">{{ __('Akan datang. Bukan dalam skop prototaip.') }}</p>
        <span class="mt-4 inline-flex items-center gap-1 text-xs uppercase tracking-wide font-semibold px-2 py-1 rounded-full bg-amber-50 text-amber-700 ring-1 ring-amber-200">
            <x-portal.icon name="lock-closed" class="w-3 h-3"/>
            {{ __('Akan Datang') }}
        </span>
        <div x-show="tip" x-transition.opacity x-cloak
             class="absolute top-full left-1/2 -translate-x-1/2 mt-2 z-30 px-3 py-1.5 rounded-md bg-navy text-white text-xs whitespace-nowrap shadow-lg pointer-events-none">
            {{ $tooltip }}
        </div>
    </div>
@elseif($variant === 'inline')
    <span x-data="{ tip: false }" x-on:mouseenter="tip = true" x-on:mouseleave="tip = false"
          class="relative inline-flex items-center gap-1 cursor-help text-navy/40 hover:text-navy/60 transition" title="{{ $tooltip }}">
        @if($icon)<x-portal.icon :name="$icon" class="w-4 h-4 opacity-60"/>@endif
        <span class="line-through decoration-dashed decoration-navy/30 underline-offset-2">{{ $label }}</span>
        <x-portal.icon name="lock-closed" class="w-3 h-3 opacity-70"/>
        <div x-show="tip" x-transition.opacity x-cloak
             class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 z-30 px-2.5 py-1 rounded bg-navy text-white text-[11px] whitespace-nowrap shadow pointer-events-none">
            {{ $tooltip }}
        </div>
    </span>
@else
    {{-- menu (default) --}}
    <div x-data="{ tip: false }" x-on:mouseenter="tip = true" x-on:mouseleave="tip = false"
         role="button" aria-disabled="true" tabindex="0" title="{{ $tooltip }}"
         class="relative flex items-start gap-3 px-3 py-2 -mx-3 rounded-lg cursor-help opacity-50 hover:opacity-75 transition group">
        @if($icon)
            <span class="w-8 h-8 rounded-lg bg-navy/5 text-navy/60 flex items-center justify-center shrink-0 relative">
                <x-portal.icon :name="$icon" class="w-4 h-4"/>
                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full bg-amber-100 ring-1 ring-amber-300 flex items-center justify-center">
                    <x-portal.icon name="lock-closed" class="w-2 h-2 text-amber-700"/>
                </span>
            </span>
        @endif
        <span class="text-sm font-medium text-navy/70 leading-tight pt-1.5 inline-flex items-center gap-1.5">
            {{ $label }}
            <span class="px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider rounded bg-amber-100 text-amber-700">{{ __('Soon') }}</span>
        </span>
        <div x-show="tip" x-transition.opacity x-cloak
             class="absolute top-full left-3 mt-1 z-30 px-2.5 py-1 rounded bg-navy text-white text-[11px] whitespace-nowrap shadow pointer-events-none">
            {{ $tooltip }}
        </div>
    </div>
@endif
