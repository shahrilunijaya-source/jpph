<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Penerbitan')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('published_at')
                            ->label('Tarikh Diterbitkan')
                            ->required()
                            ->default(now()),
                        DateTimePicker::make('expires_at')
                            ->label('Tarikh Tamat (Pilihan)')
                            ->helperText('Kosongkan jika hebahan tiada tarikh tamat'),
                        FileUpload::make('image_path')
                            ->label('Gambar (Pilihan)')
                            ->image()
                            ->disk('public')
                            ->directory('announcements')
                            ->columnSpanFull(),
                    ]),
                Section::make('Bahasa Malaysia')
                    ->schema([
                        TextInput::make('title_bm')->label('Tajuk (BM)')->required()->maxLength(255),
                        Textarea::make('excerpt_bm')->label('Ringkasan (BM)')->required()->rows(3)->maxLength(500),
                    ]),
                Section::make('English')
                    ->schema([
                        TextInput::make('title_en')->label('Title (EN)')->required()->maxLength(255),
                        Textarea::make('excerpt_en')->label('Excerpt (EN)')->required()->rows(3)->maxLength(500),
                    ]),
            ]);
    }
}
