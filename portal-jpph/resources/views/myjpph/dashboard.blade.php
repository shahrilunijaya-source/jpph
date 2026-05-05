<x-portal.dashboard-layout title="{{ __('Papan Pemuka') }}">
    @php
        $user = auth()->user();
        $firstName = explode(' ', $user?->name ?? 'Warga')[0];
        $today = \Carbon\Carbon::now()->locale(app()->getLocale())->isoFormat('dddd, D MMMM Y');

        $inProgressStatuses = ['diterima', 'dalam_semakan', 'menunggu_dokumen'];
        $attentionStatuses = ['menunggu_dokumen'];

        $totalDS = \App\Models\CaseDutiSetem::count();
        $totalPP = \App\Models\CasePinjamanPerumahan::count();
        $totalTS = \App\Models\CaseTukarSyarat::count();

        $progressDS = \App\Models\CaseDutiSetem::whereIn('status', $inProgressStatuses)->count();
        $progressPP = \App\Models\CasePinjamanPerumahan::whereIn('status', $inProgressStatuses)->count();
        $progressTS = \App\Models\CaseTukarSyarat::whereIn('status', $inProgressStatuses)->count();

        $attentionDS = \App\Models\CaseDutiSetem::whereIn('status', $attentionStatuses)->count();
        $attentionPP = \App\Models\CasePinjamanPerumahan::whereIn('status', $attentionStatuses)->count();
        $attentionTS = \App\Models\CaseTukarSyarat::whereIn('status', $attentionStatuses)->count();

        $approvedDS = \App\Models\CaseDutiSetem::where('status', 'diluluskan')->count();
        $approvedPP = \App\Models\CasePinjamanPerumahan::where('status', 'diluluskan')->count();
        $approvedTS = \App\Models\CaseTukarSyarat::where('status', 'diluluskan')->count();

        $rejectedDS = \App\Models\CaseDutiSetem::where('status', 'ditolak')->count();
        $rejectedPP = \App\Models\CasePinjamanPerumahan::where('status', 'ditolak')->count();
        $rejectedTS = \App\Models\CaseTukarSyarat::where('status', 'ditolak')->count();

        $kpi = [
            'total'     => $totalDS + $totalPP + $totalTS,
            'progress'  => $progressDS + $progressPP + $progressTS,
            'attention' => $attentionDS + $attentionPP + $attentionTS,
            'approved'  => $approvedDS + $approvedPP + $approvedTS,
            'rejected'  => $rejectedDS + $rejectedPP + $rejectedTS,
        ];

        $statusMap = [
            'diterima'         => ['key' => 'sub', 'label' => __('Diterima')],
            'dalam_semakan'    => ['key' => 'rev', 'label' => __('Dalam Semakan')],
            'menunggu_dokumen' => ['key' => 'rev', 'label' => __('Menunggu Dokumen')],
            'diluluskan'       => ['key' => 'ok',  'label' => __('Diluluskan')],
            'ditolak'          => ['key' => 'rej', 'label' => __('Ditolak')],
        ];

        $mapCase = function ($c, $jenisLabel, $tajukFallback) use ($statusMap) {
            return [
                'no'     => $c->no_rujukan,
                'tajuk'  => $tajukFallback,
                'jenis'  => $jenisLabel,
                'status' => $statusMap[$c->status]['key'] ?? 'sub',
                'status_label' => $statusMap[$c->status]['label'] ?? ucfirst($c->status),
                'tarikh' => optional($c->tarikh_terima)->translatedFormat('d M Y') ?: '-',
                'sort'   => $c->tarikh_terima,
            ];
        };

        $recentDS = \App\Models\CaseDutiSetem::latest('tarikh_terima')->take(5)->get()
            ->map(fn ($c) => $mapCase($c, __('Duti Setem'), $c->jenis_pindahmilik ?: __('Permohonan Duti Setem')));
        $recentPP = \App\Models\CasePinjamanPerumahan::latest('tarikh_terima')->take(5)->get()
            ->map(fn ($c) => $mapCase($c, __('Pinjaman Perumahan'), __('Pinjaman Perumahan')));
        $recentTS = \App\Models\CaseTukarSyarat::latest('tarikh_terima')->take(5)->get()
            ->map(fn ($c) => $mapCase($c, __('Tukar Syarat'), __('Tukar Syarat Tanah')));

        $recent = collect()
            ->concat($recentDS)
            ->concat($recentPP)
            ->concat($recentTS)
            ->sortByDesc('sort')
            ->take(5)
            ->values();
    @endphp

    {{-- Page heading --}}
    <div class="pg-head">
        <div>
            <div class="pg-title">{{ __('Selamat datang, ') . $firstName }}</div>
            <div class="pg-sub">
                {{ $today }}
                &nbsp;·&nbsp;
                {{ __('Jabatan Penilaian dan Perkhidmatan Harta') }}
            </div>
        </div>
    </div>

    {{-- KPI grid --}}
    <div class="kpi-row">
        <div class="kpi accent-navy">
            <div class="kpi-lbl">{{ __('Jumlah Kes') }}</div>
            <div class="kpi-val v-navy">{{ $kpi['total'] }}</div>
            <div class="kpi-foot">{{ __('Keseluruhan kes ditugaskan') }}</div>
        </div>
        <div class="kpi accent-amber">
            <div class="kpi-lbl">{{ __('Dalam Proses') }}</div>
            <div class="kpi-val v-amber">{{ $kpi['progress'] }}</div>
            <div class="kpi-foot">
                <strong>{{ $kpi['attention'] }}</strong>&nbsp;{{ __('perlu perhatian') }}
            </div>
        </div>
        <div class="kpi accent-brand">
            <div class="kpi-lbl">{{ __('Diluluskan') }}</div>
            <div class="kpi-val v-brand">{{ $kpi['approved'] }}</div>
            <div class="kpi-foot">{{ __('Kes berjaya diselesaikan') }}</div>
        </div>
        <div class="kpi accent-red">
            <div class="kpi-lbl">{{ __('Ditolak') }}</div>
            <div class="kpi-val v-red">{{ $kpi['rejected'] }}</div>
            <div class="kpi-foot">{{ __('Semak sebab penolakan') }}</div>
        </div>
    </div>

    {{-- Recent cases --}}
    <div class="card">
        <div class="card-head">
            <span class="card-title">{{ __('Kes Terkini') }}</span>
            <span class="card-meta">{{ count($recent) }} {{ __('daripada') }} {{ $kpi['total'] }}</span>
            <a href="#" class="card-link">
                {{ __('Lihat semua') }}
                <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>{{ __('No. Kes') }}</th>
                        <th>{{ __('Tajuk') }}</th>
                        <th>{{ __('Jenis') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Tarikh') }}</th>
                        <th style="width:80px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent as $r)
                        <tr>
                            <td><span class="app-chip">{{ $r['no'] }}</span></td>
                            <td>
                                <div class="prod-name">{{ $r['tajuk'] }}</div>
                            </td>
                            <td style="color:var(--text-3);font-size:13px">{{ $r['jenis'] }}</td>
                            <td><span class="st st-{{ $r['status'] }}">{{ $r['status_label'] }}</span></td>
                            <td style="font-size:12px;color:var(--text-4);white-space:nowrap">{{ $r['tarikh'] }}</td>
                            <td>
                                <a href="#" class="tbl-action">{{ __('Semak') }} →</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-portal.dashboard-layout>
