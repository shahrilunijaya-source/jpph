<x-guest-layout>
    <div class="min-h-screen grid lg:grid-cols-[1fr_1.1fr] bg-white">

        {{-- LEFT: navy panel w/ branding + features --}}
        <aside class="relative overflow-hidden bg-navy text-white p-8 lg:p-14 flex flex-col">
            <x-portal.hero-bg variant="waves" />

            <div class="relative flex items-center gap-5">
                <img src="/images/jata-negara.png" alt="Jata Negara" class="h-24 lg:h-28 w-auto object-contain drop-shadow-lg">
                <img src="/images/jpph-logo.png" alt="Logo JPPH" class="h-24 lg:h-28 w-auto object-contain bg-white/95 rounded-xl p-2 shadow-2xl ring-1 ring-white/20">
            </div>

            <span class="relative mt-8 inline-flex w-fit items-center gap-2 px-3 py-1 rounded-full bg-gold/20 text-gold text-xs font-bold uppercase tracking-widest ring-1 ring-gold/30">
                <x-portal.icon name="building-library" class="w-3.5 h-3.5"/>
                MyJPPH · Portal Intranet
            </span>

            <div class="relative mt-10 max-w-lg">
                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-extrabold leading-[1.05] tracking-tight">
                    My<span class="text-gold">JPPH</span>
                </h1>
                <p class="mt-4 text-2xl md:text-3xl font-display font-semibold text-white/90">
                    Sistem Dalaman Warga JPPH
                </p>
                <p class="mt-3 text-white/70 leading-relaxed">
                    Akses dalaman pegawai, penyelia, dan pentadbir Jabatan Penilaian dan Perkhidmatan Harta.
                </p>
            </div>

            <ul class="relative mt-8 space-y-3 max-w-md">
                @foreach([
                    ['icon' => 'document-text', 'text' => 'CMS Pages, Hebahan & FAQ Management'],
                    ['icon' => 'check-circle', 'text' => 'Audit Trail Log Kekal'],
                    ['icon' => 'chart-bar', 'text' => 'Dashboard Statistik & Pelaporan'],
                    ['icon' => 'lock-closed', 'text' => 'Pematuhan PPPA Bil.1/2025 + ISMS ISO 27001'],
                ] as $f)
                    <li class="flex items-start gap-3 text-sm">
                        <span class="w-7 h-7 rounded-lg bg-gold/15 text-gold flex items-center justify-center shrink-0 mt-0.5">
                            <x-portal.icon :name="$f['icon']" class="w-4 h-4"/>
                        </span>
                        <span class="text-white/85 pt-1">{{ $f['text'] }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="relative mt-auto pt-10 text-xs text-white/50 leading-relaxed">
                <p>&copy; {{ date('Y') }} Jabatan Penilaian dan Perkhidmatan Harta · Kementerian Kewangan Malaysia.</p>
                <p class="mt-1">Akses terhad kepada warga JPPH dengan akaun rasmi.</p>
            </div>
        </aside>

        {{-- RIGHT: form panel --}}
        <main class="relative bg-gradient-to-br from-white via-gray-50 to-gold/5 px-6 py-10 lg:px-16 lg:py-14 flex flex-col">

            <div class="flex items-center justify-between text-sm">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-navy/70 hover:text-navy font-medium transition">
                    <x-portal.icon name="arrow-right" class="w-4 h-4 rotate-180"/>
                    {{ __('Kembali ke Laman Utama') }}
                </a>
                <a href="{{ route('locale.switch', app()->getLocale() === 'ms' ? 'en' : 'ms') }}" class="inline-flex items-center gap-1 text-xs text-navy/60 hover:text-navy px-2 py-1 rounded border border-navy/15 hover:border-navy/30">
                    {{ strtoupper(app()->getLocale()) }} <span class="opacity-50">/</span> <span class="opacity-70">{{ strtoupper(app()->getLocale() === 'ms' ? 'en' : 'ms') }}</span>
                </a>
            </div>

            <div class="flex-1 flex items-center justify-center mt-8">
                <div class="w-full max-w-md">

                    {{-- Card --}}
                    <div class="relative bg-white rounded-2xl shadow-2xl ring-1 ring-navy/10 p-8 lg:p-10">
                        {{-- top gold accent --}}
                        <div class="absolute -top-px left-12 right-12 h-1 bg-gradient-to-r from-transparent via-gold to-transparent rounded-full"></div>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-navy text-gold text-[11px] font-bold uppercase tracking-widest">
                            <x-portal.icon name="lock-closed" class="w-3 h-3"/>
                            Portal Pegawai
                        </span>

                        <h2 class="mt-4 font-display text-3xl font-bold text-navy">{{ __('Log Masuk Pegawai') }}</h2>
                        <p class="mt-1.5 text-sm text-navy/60">{{ __('Untuk pegawai, penyelia, dan pentadbir JPPH sahaja.') }}</p>

                        @if (session('status'))
                            <div class="mt-4 px-3 py-2 bg-green-50 text-green-800 text-sm rounded-lg ring-1 ring-green-200">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-4 px-3 py-2 bg-red-50 text-red-700 text-sm rounded-lg ring-1 ring-red-200">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-semibold text-navy">
                                    {{ __('Alamat Emel') }}<span class="text-red-500">*</span>
                                </label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                       placeholder="contoh@jpph.gov.my"
                                       class="mt-1.5 w-full px-4 py-3 rounded-lg border border-navy/15 bg-white text-navy placeholder-navy/30 focus:ring-2 focus:ring-gold focus:border-gold focus:outline-none transition">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-navy">
                                    {{ __('Kata Laluan') }}<span class="text-red-500">*</span>
                                </label>
                                <input id="password" name="password" type="password" required autocomplete="current-password"
                                       class="mt-1.5 w-full px-4 py-3 rounded-lg border border-navy/15 bg-white text-navy focus:ring-2 focus:ring-gold focus:border-gold focus:outline-none transition">
                            </div>

                            <div class="flex items-center justify-between">
                                <label for="remember" class="inline-flex items-center gap-2 cursor-pointer">
                                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 rounded border-navy/30 text-gold focus:ring-gold">
                                    <span class="text-sm text-navy/70">{{ __('Ingat saya') }}</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-gold-600 hover:text-gold font-medium">
                                        {{ __('Lupa kata laluan?') }}
                                    </a>
                                @endif
                            </div>

                            <button type="submit"
                                    class="w-full py-3.5 bg-navy hover:bg-navy-700 text-white font-semibold rounded-lg shadow-lg shadow-navy/20 hover:shadow-xl hover:shadow-navy/30 transition-all inline-flex items-center justify-center gap-2 group">
                                <x-portal.icon name="building-library" class="w-4 h-4"/>
                                {{ __('Log Masuk Pegawai') }}
                                <x-portal.icon name="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition"/>
                            </button>
                        </form>

                        <div class="mt-6 pt-5 border-t border-navy/10 text-center">
                            <p class="text-xs text-navy/55">{{ __('Akaun pegawai diuruskan oleh Pentadbir Sistem') }}</p>
                            <details class="mt-3 text-left">
                                <summary class="text-sm text-gold-600 hover:text-gold font-medium cursor-pointer text-center inline-block">
                                    {{ __('Lihat Akaun Demo') }} →
                                </summary>
                                <div class="mt-3 grid gap-2 text-xs">
                                    @foreach([
                                        ['role' => 'Super Admin',       'email' => 'super@jpph.demo'],
                                        ['role' => 'Pentadbir Kandungan','email' => 'admin@jpph.demo'],
                                        ['role' => 'Pegawai',            'email' => 'staff@jpph.demo'],
                                    ] as $d)
                                        <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-navy/[0.03] ring-1 ring-navy/5">
                                            <div>
                                                <div class="font-semibold text-navy">{{ $d['role'] }}</div>
                                                <div class="font-mono text-navy/60">{{ $d['email'] }}</div>
                                            </div>
                                            <span class="text-[10px] uppercase tracking-wider text-navy/40">Demo!2026</span>
                                        </div>
                                    @endforeach
                                </div>
                            </details>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-center gap-4 text-[11px] text-navy/40">
                        <span class="inline-flex items-center gap-1">
                            <x-portal.icon name="lock-closed" class="w-3 h-3"/>
                            HTTPS · TLS 1.3
                        </span>
                        <span>·</span>
                        <span>Pematuhan PDPA Akta 709</span>
                        <span>·</span>
                        <span>ISO 27001</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-guest-layout>
