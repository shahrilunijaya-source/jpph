<?php

namespace App\Filament\Widgets;

use App\Models\CaseDutiSetem;
use App\Models\CasePinjamanPerumahan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CaseStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $diluluskan = CaseDutiSetem::where('status', 'diluluskan')->count();
        $dalamSemakan = CaseDutiSetem::where('status', 'dalam_semakan')->count() + CaseDutiSetem::where('status', 'menunggu_dokumen')->count();
        $jumlahDS = CaseDutiSetem::count();
        $jumlahPP = CasePinjamanPerumahan::count();
        $nilaiHartanah = (float) CaseDutiSetem::sum('nilai_hartanah_rm');

        return [
            Stat::make('Duti Setem (Diluluskan)', number_format($diluluskan))
                ->description('Sepanjang masa')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Duti Setem (Dalam Tindakan)', number_format($dalamSemakan))
                ->description('Dalam semakan + menunggu dokumen')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Jumlah Kes', number_format($jumlahDS + $jumlahPP))
                ->description("Duti Setem: {$jumlahDS} • Pinjaman: {$jumlahPP}")
                ->descriptionIcon('heroicon-m-folder')
                ->color('primary'),
            Stat::make('Nilai Hartanah Dinilai', 'RM '.number_format($nilaiHartanah, 0))
                ->description('Jumlah kumulatif')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('gray'),
        ];
    }
}
