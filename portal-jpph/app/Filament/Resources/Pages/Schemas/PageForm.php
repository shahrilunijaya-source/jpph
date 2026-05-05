<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Maklumat Asas')
                    ->columns(2)
                    ->schema([
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(120)
                            ->helperText('Pengenal pasti URL-friendly. Contoh: latar-belakang')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Toggle::make('published')
                            ->label('Diterbitkan')
                            ->default(true)
                            ->columnSpan(1),
                    ]),
                Section::make('Bahasa Malaysia')
                    ->schema([
                        TextInput::make('title_bm')->label('Tajuk (BM)')->required()->maxLength(255),
                        RichEditor::make('body_bm')->label('Kandungan (BM)')->required()->columnSpanFull(),
                    ]),
                Section::make('English')
                    ->schema([
                        TextInput::make('title_en')->label('Title (EN)')->required()->maxLength(255),
                        RichEditor::make('body_en')->label('Body (EN)')->required()->columnSpanFull(),
                    ]),
            ]);
    }
}
