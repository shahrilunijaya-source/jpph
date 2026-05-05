<?php

namespace App\Filament\Resources\CasePinjamanPerumahans\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CasePinjamanPerumahansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_rujukan')->label('No. Rujukan')->searchable()->sortable(),
                TextColumn::make('pemohon_nama')->label('Pemohon')->searchable()->limit(30),
                TextColumn::make('bank')->searchable(),
                TextColumn::make('nilai_pasaran_rm')
                    ->label('Nilai Pasaran (RM)')
                    ->money('MYR')
                    ->placeholder('Belum dinilai'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'dihantar_bank',
                        'warning' => 'dalam_penilaian',
                        'gray' => 'diterima',
                        'info' => 'siap_laporan',
                    ])
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'diterima' => 'Diterima',
                        'dalam_penilaian' => 'Dalam Penilaian',
                        'siap_laporan' => 'Siap Laporan',
                        'dihantar_bank' => 'Dihantar Bank',
                        default => $state,
                    }),
                TextColumn::make('tarikh_terima')->label('Tarikh Terima')->date('d/m/Y')->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'diterima' => 'Diterima',
                    'dalam_penilaian' => 'Dalam Penilaian',
                    'siap_laporan' => 'Siap Laporan',
                    'dihantar_bank' => 'Dihantar Bank',
                ]),
                SelectFilter::make('bank')
                    ->options(fn () => \App\Models\CasePinjamanPerumahan::query()->select('bank')->distinct()->pluck('bank', 'bank')->toArray()),
            ])
            ->recordActions([])
            ->toolbarActions([])
            ->defaultSort('tarikh_terima', 'desc');
    }
}
