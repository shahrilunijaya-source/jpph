<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-mode="" x-data="{ mode: localStorage.getItem('jpph-mode') || '' }" :data-mode="mode" x-init="document.documentElement.setAttribute('data-mode', mode)">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0A2540">
    <title>{{ $title ?? __('Portal Rasmi JPPH — Perkhidmatan Bernilai, Komitmen Kami') }}</title>
    <meta name="description" content="{{ __('Portal Rasmi Jabatan Penilaian dan Perkhidmatan Harta (JPPH) — perkhidmatan penilaian harta tanah dan harta alih untuk rakyat, profesional, dan agensi.') }}">
    <link rel="icon" href="/favicon.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans bg-white text-navy antialiased min-h-screen flex flex-col">
    <a href="#main" class="skip-link">{{ __('Langkau ke kandungan utama') }}</a>

    <x-portal.nav />

    <main id="main" class="flex-1">
        {{ $slot ?? '' }}
        @isset($content)
            {!! $content !!}
        @endisset
        @yield('content')
    </main>

    <x-portal.footer />

    <livewire:chatbot-fab />

    @livewireScripts
</body>
</html>
