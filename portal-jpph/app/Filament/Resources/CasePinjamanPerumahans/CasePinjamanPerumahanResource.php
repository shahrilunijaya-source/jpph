<?php

namespace App\Filament\Resources\CasePinjamanPerumahans;

use App\Filament\Resources\CasePinjamanPerumahans\Pages\ListCasePinjamanPerumahans;
use App\Filament\Resources\CasePinjamanPerumahans\Tables\CasePinjamanPerumahansTable;
use App\Models\CasePinjamanPerumahan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CasePinjamanPerumahanResource extends Resource
{
    protected static ?string $model = CasePinjamanPerumahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?string $navigationLabel = 'Kes Pinjaman Perumahan';

    protected static ?string $modelLabel = 'Kes Pinjaman Perumahan';

    protected static ?string $pluralModelLabel = 'Kes Pinjaman Perumahan';

    public static function table(Table $table): Table
    {
        return CasePinjamanPerumahansTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCasePinjamanPerumahans::route('/'),
        ];
    }
}
