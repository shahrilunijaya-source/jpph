@php
    $locale = app()->getLocale();
    $colorMap = ['navy' => 'bg-navy/5 text-navy', 'gold' => 'bg-gold/15 text-gold-600', 'green' => 'bg-green-50 text-green-700'];
    $statusLabelsArr = array_values(array_map(fn ($s) => $statusLabelsBM[$s] ?? $s, $statusOrder));
    $statusValues = array_values(array_map(fn ($s) => $statusDist[$s] ?? 0, $statusOrder));
@endphp
<div>
    {{-- Header --}}
    <section class="bg-navy text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <span class="text-xs uppercase tracking-widest text-gold font-semibold">{{ __('Statistik & Prestasi') }}</span>
            <h1 class="font-display text-3xl md:text-5xl font-bold mt-2">{{ __('Dashboard JPPH') }}</h1>
            <p class="mt-2 text-white/70 max-w-2xl">{{ __('Statistik kes duti setem dan pinjaman perumahan secara langsung dari pangkalan data.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 -mt-8 pb-24 relative z-10">
        {{-- KPI tiles --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($kpis as $k)
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6 motion-safe:animate-fade-up">
                    <div class="flex items-start justify-between">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $colorMap[$k['color']] ?? $colorMap['navy'] }}">
                            <x-portal.icon :name="$k['icon']" class="w-6 h-6"/>
                        </div>
                        <span class="text-xs font-semibold {{ str_starts_with($k['delta'], '-') ? 'text-red-600' : 'text-green-600' }}">{{ $k['delta'] }}</span>
                    </div>
                    <div class="mt-4 text-3xl font-display font-bold text-navy">{{ $k['value'] }}</div>
                    <div class="mt-1 text-sm text-navy/60">{{ $locale === 'ms' ? $k['label_ms'] : $k['label_en'] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Charts row 1 --}}
        <div class="grid lg:grid-cols-3 gap-4 mt-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-display font-bold text-navy text-lg">{{ __('Trend Kes 12 Bulan') }}</h3>
                        <p class="text-xs text-navy/50 mt-0.5">{{ __('Kes baharu setiap bulan, mengikut jenis') }}</p>
                    </div>
                    <div class="flex gap-3 text-xs">
                        <span class="inline-flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-navy"></span> {{ __('Duti Setem') }}</span>
                        <span class="inline-flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-gold"></span> {{ __('Pinjaman') }}</span>
                    </div>
                </div>
                <div class="relative" style="height: 320px;" wire:ignore>
                    <canvas id="chart-trend"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6">
                <h3 class="font-display font-bold text-navy text-lg">{{ __('Status Kes Duti Setem') }}</h3>
                <p class="text-xs text-navy/50 mt-0.5 mb-4">{{ __('Taburan keseluruhan') }}</p>
                <div class="relative" style="height: 240px;" wire:ignore>
                    <canvas id="chart-status"></canvas>
                </div>
            </div>
        </div>

        {{-- Charts row 2 --}}
        <div class="grid lg:grid-cols-2 gap-4 mt-4">
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6">
                <h3 class="font-display font-bold text-navy text-lg">{{ __('Cawangan Tertinggi') }}</h3>
                <p class="text-xs text-navy/50 mt-0.5 mb-4">{{ __('Bilangan kes duti setem mengikut cawangan') }}</p>
                <div class="relative" style="height: 320px;" wire:ignore>
                    <canvas id="chart-branches"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-navy/10 p-6">
                <h3 class="font-display font-bold text-navy text-lg">{{ __('Pinjaman Mengikut Bank') }}</h3>
                <p class="text-xs text-navy/50 mt-0.5 mb-4">{{ __('Bilangan permohonan penilaian') }}</p>
                <div class="relative" style="height: 320px;" wire:ignore>
                    <canvas id="chart-banks"></canvas>
                </div>
            </div>
        </div>

        <div class="mt-8 p-4 bg-navy/5 rounded-xl text-sm text-navy/70">
            <strong class="text-navy">{{ __('Sumber data:') }}</strong>
            {{ __('Data demo dijana untuk tujuan prototaip. Dalam pelaksanaan sebenar, statistik akan dipaparkan secara masa-nyata daripada pangkalan data sistem JPPH dengan polisi privasi yang dikuatkuasakan.') }}
        </div>
    </section>

    @push('scripts')
    @endpush

    <script>
    (function() {
        const months = @json($months);
        const monthlyDS = @json($monthlyDS);
        const monthlyPP = @json($monthlyPP);
        const statusLabels = @json($statusLabelsArr);
        const statusValues = @json($statusValues);
        const branches = @json($branches);
        const banks = @json($banks);

        function init() {
            if (!window.Chart || !window.jpphChart) {
                setTimeout(init, 50);
                return;
            }

            window.jpphChart(document.getElementById('chart-trend'), {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Duti Setem', data: monthlyDS, borderColor: '#0A2540', backgroundColor: 'rgba(10,37,64,0.08)', fill: true, tension: 0.35, pointRadius: 3, pointBackgroundColor: '#0A2540' },
                        { label: 'Pinjaman Perumahan', data: monthlyPP, borderColor: '#F59E0B', backgroundColor: 'rgba(245,158,11,0.10)', fill: true, tension: 0.35, pointRadius: 3, pointBackgroundColor: '#F59E0B' }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: 800, easing: 'easeOutQuart' },
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } }, x: { grid: { display: false } } }
                }
            });

            window.jpphChart(document.getElementById('chart-status'), {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{ data: statusValues, backgroundColor: ['#16A34A','#D97706','#F59E0B','#3B82F6','#DC2626'], borderColor: '#fff', borderWidth: 2 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '60%',
                    animation: { duration: 800 },
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 8, font: { size: 11 } } } }
                }
            });

            window.jpphChart(document.getElementById('chart-branches'), {
                type: 'bar',
                data: {
                    labels: Object.keys(branches),
                    datasets: [{ label: 'Kes', data: Object.values(branches), backgroundColor: '#0A2540', borderRadius: 6 }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: 800 },
                    plugins: { legend: { display: false } },
                    scales: { x: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });

            window.jpphChart(document.getElementById('chart-banks'), {
                type: 'bar',
                data: {
                    labels: Object.keys(banks),
                    datasets: [{ label: 'Permohonan', data: Object.values(banks), backgroundColor: '#F59E0B', borderRadius: 6 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    animation: { duration: 800 },
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
    </script>
</div>
