<?php

namespace App\Filament\Resources\CaseDutiSetems\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CaseDutiSetemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_rujukan')->label('No. Rujukan')->searchable()->sortable(),
                TextColumn::make('pemohon_nama')->label('Pemohon')->searchable()->limit(40),
                TextColumn::make('cawangan')->searchable(),
                TextColumn::make('nilai_hartanah_rm')
                    ->label('Nilai (RM)')
                    ->money('MYR')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'diluluskan',
                        'warning' => fn ($state) => in_array($state, ['dalam_semakan', 'menunggu_dokumen']),
                        'danger' => 'ditolak',
                        'gray' => 'diterima',
                    ])
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'diterima' => 'Diterima',
                        'dalam_semakan' => 'Dalam Semakan',
                        'diluluskan' => 'Diluluskan',
                        'ditolak' => 'Ditolak',
                        'menunggu_dokumen' => 'Menunggu Dokumen',
                        default => $state,
                    }),
                TextColumn::make('tarikh_terima')->label('Tarikh Terima')->date('d/m/Y')->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'diterima' => 'Diterima',
                    'dalam_semakan' => 'Dalam Semakan',
                    'diluluskan' => 'Diluluskan',
                    'ditolak' => 'Ditolak',
                    'menunggu_dokumen' => 'Menunggu Dokumen',
                ]),
            ])
            ->recordActions([])
            ->toolbarActions([])
            ->defaultSort('tarikh_terima', 'desc');
    }
}
