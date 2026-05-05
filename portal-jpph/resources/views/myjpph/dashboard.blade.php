<x-portal.dashboard-layout title="{{ __('Papan Pemuka') }}">
    @php
        $user = auth()->user();
        $firstName = explode(' ', $user?->name ?? 'Warga')[0];
        $today = \Carbon\Carbon::now()->locale(app()->getLocale())->isoFormat('dddd, D MMMM Y');

        // Demo data — wire to real models later.
        $kpi = [
            'total'    => 47,
            'progress' => 18,
            'attention'=> 5,
            'approved' => 26,
            'rejected' => 3,
        ];

        $recent = [
            ['no' => 'JPPH/DS/2026/00481', 'tajuk' => 'Pindah Milik Premis Komersial', 'jenis' => 'Duti Setem',          'status' => 'rev', 'status_label' => 'Dalam Penilaian', 'tarikh' => '03 Mei 2026'],
            ['no' => 'JPPH/PP/2026/00132', 'tajuk' => 'Pinjaman Perumahan Kerajaan',    'jenis' => 'Pinjaman Perumahan',  'status' => 'ok',  'status_label' => 'Diluluskan',     'tarikh' => '02 Mei 2026'],
            ['no' => 'JPPH/TS/2026/00067', 'tajuk' => 'Tukar Syarat Tanah Pertanian',   'jenis' => 'Tukar Syarat',        'status' => 'sub', 'status_label' => 'Diserah',        'tarikh' => '01 Mei 2026'],
            ['no' => 'JPPH/DS/2026/00478', 'tajuk' => 'Sewaan Hartanah Industri',       'jenis' => 'Duti Setem',          'status' => 'rej', 'status_label' => 'Ditolak',        'tarikh' => '28 Apr 2026'],
            ['no' => 'JPPH/PP/2026/00128', 'tajuk' => 'Pembelian Rumah Pertama',         'jenis' => 'Pinjaman Perumahan',  'status' => 'rev', 'status_label' => 'Semakan Dokumen','tarikh' => '27 Apr 2026'],
        ];
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
