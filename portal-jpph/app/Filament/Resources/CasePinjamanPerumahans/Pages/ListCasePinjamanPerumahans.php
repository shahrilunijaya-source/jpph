<?php

namespace App\Filament\Resources\CasePinjamanPerumahans\Pages;

use App\Filament\Resources\CasePinjamanPerumahans\CasePinjamanPerumahanResource;
use Filament\Resources\Pages\ListRecords;

class ListCasePinjamanPerumahans extends ListRecords
{
    protected static string $resource = CasePinjamanPerumahanResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
