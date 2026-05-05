<?php

namespace App\Filament\Resources\CaseDutiSetems\Pages;

use App\Filament\Resources\CaseDutiSetems\CaseDutiSetemResource;
use Filament\Resources\Pages\ListRecords;

class ListCaseDutiSetems extends ListRecords
{
    protected static string $resource = CaseDutiSetemResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
