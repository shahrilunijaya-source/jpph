<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_bm')->label('Soalan (BM)')->searchable()->limit(80),
                TextColumn::make('category')->label('Kategori')->badge()->color('gray'),
                TextColumn::make('sort_order')->label('Susunan')->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')->options([
                    'umum' => 'Umum',
                    'duti_setem' => 'Duti Setem',
                    'pinjaman_perumahan' => 'Pinjaman Perumahan',
                    'tukar_syarat' => 'Tukar Syarat',
                    'sewaan' => 'Sewaan',
                    'perkhidmatan' => 'Perkhidmatan',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }
}
