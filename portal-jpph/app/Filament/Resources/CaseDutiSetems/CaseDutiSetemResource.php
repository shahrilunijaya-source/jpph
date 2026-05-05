<?php

namespace App\Filament\Resources\CaseDutiSetems;

use App\Filament\Resources\CaseDutiSetems\Pages\ListCaseDutiSetems;
use App\Filament\Resources\CaseDutiSetems\Tables\CaseDutiSetemsTable;
use App\Models\CaseDutiSetem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CaseDutiSetemResource extends Resource
{
    protected static ?string $model = CaseDutiSetem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Kes Duti Setem';

    protected static ?string $modelLabel = 'Kes Duti Setem';

    protected static ?string $pluralModelLabel = 'Kes Duti Setem';

    public static function table(Table $table): Table
    {
        return CaseDutiSetemsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCaseDutiSetems::route('/'),
        ];
    }
}
