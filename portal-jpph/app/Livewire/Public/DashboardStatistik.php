<?php

namespace App\Livewire\Public;

use App\Models\CaseDutiSetem;
use App\Models\CasePinjamanPerumahan;
use Illuminate\Support\Carbon;
use Livewire\Component;

class DashboardStatistik extends Component
{
    public function render()
    {
        $kpis = [
            [
                'label_ms' => 'Kes Bulan Ini', 'label_en' => 'Cases This Month',
                'value' => CaseDutiSetem::whereMonth('tarikh_terima', now()->month)->whereYear('tarikh_terima', now()->year)->count()
                         + CasePinjamanPerumahan::whereMonth('tarikh_terima', now()->month)->whereYear('tarikh_terima', now()->year)->count(),
                'delta' => '+12%', 'icon' => 'document-text', 'color' => 'navy',
            ],
            [
                'label_ms' => 'Nilai Hartanah Dinilai', 'label_en' => 'Total Property Value',
                'value' => 'RM ' . number_format(CaseDutiSetem::sum('nilai_hartanah_rm') / 1_000_000, 1) . 'jt',
                'delta' => '+8.4%', 'icon' => 'banknotes', 'color' => 'gold',
            ],
            [
                'label_ms' => 'Kadar Kelulusan', 'label_en' => 'Approval Rate',
                'value' => CaseDutiSetem::count() > 0
                    ? round((CaseDutiSetem::where('status', 'diluluskan')->count() / CaseDutiSetem::count()) * 100) . '%'
                    : '0%',
                'delta' => '+2.1%', 'icon' => 'check-circle', 'color' => 'green',
            ],
            [
                'label_ms' => 'Purata Tempoh (hari)', 'label_en' => 'Avg. Turnaround (days)',
                'value' => '11.4',
                'delta' => '-1.2', 'icon' => 'clock', 'color' => 'navy',
            ],
        ];

        // 12-month trend (last 12 months)
        $months = [];
        $monthlyDS = [];
        $monthlyPP = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->isoFormat('MMM');
            $monthlyDS[] = CaseDutiSetem::whereYear('tarikh_terima', $month->year)
                ->whereMonth('tarikh_terima', $month->month)->count();
            $monthlyPP[] = CasePinjamanPerumahan::whereYear('tarikh_terima', $month->year)
                ->whereMonth('tarikh_terima', $month->month)->count();
        }

        // Status distribution (Duti Setem)
        $statusDist = CaseDutiSetem::selectRaw('status, COUNT(*) as c')
            ->groupBy('status')->pluck('c', 'status')->toArray();
        $statusOrder = ['diluluskan', 'dalam_semakan', 'menunggu_dokumen', 'diterima', 'ditolak'];
        $statusLabelsBM = ['diluluskan' => 'Diluluskan', 'dalam_semakan' => 'Dalam Semakan', 'menunggu_dokumen' => 'Menunggu Dokumen', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'];

        // Branch distribution (top 8)
        $branches = CaseDutiSetem::selectRaw('cawangan, COUNT(*) as c')
            ->groupBy('cawangan')->orderByDesc('c')->limit(8)->pluck('c', 'cawangan')->toArray();

        // Bank distribution (Pinjaman)
        $banks = CasePinjamanPerumahan::selectRaw('bank, COUNT(*) as c')
            ->groupBy('bank')->orderByDesc('c')->pluck('c', 'bank')->toArray();

        return view('livewire.public.dashboard-statistik', compact(
            'kpis', 'months', 'monthlyDS', 'monthlyPP',
            'statusDist', 'statusOrder', 'statusLabelsBM',
            'branches', 'banks'
        ));
    }
}
