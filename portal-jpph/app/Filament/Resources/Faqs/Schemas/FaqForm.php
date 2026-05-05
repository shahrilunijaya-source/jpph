<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Klasifikasi')
                    ->columns(2)
                    ->schema([
                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'umum' => 'Umum',
                                'duti_setem' => 'Duti Setem',
                                'pinjaman_perumahan' => 'Pinjaman Perumahan',
                                'tukar_syarat' => 'Tukar Syarat',
                                'sewaan' => 'Sewaan',
                                'perkhidmatan' => 'Perkhidmatan',
                            ])
                            ->required()
                            ->default('umum'),
                        TextInput::make('sort_order')
                            ->label('Susunan')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Soalan')
                    ->columns(1)
                    ->schema([
                        Textarea::make('question_bm')->label('Soalan (BM)')->required()->rows(2),
                        Textarea::make('question_en')->label('Question (EN)')->required()->rows(2),
                    ]),
                Section::make('Jawapan')
                    ->columns(1)
                    ->schema([
                        Textarea::make('answer_bm')->label('Jawapan (BM)')->required()->rows(4),
                        Textarea::make('answer_en')->label('Answer (EN)')->required()->rows(4),
                    ]),
            ]);
    }
}
