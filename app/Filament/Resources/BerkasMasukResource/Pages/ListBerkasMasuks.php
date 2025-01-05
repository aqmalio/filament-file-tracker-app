<?php

namespace App\Filament\Resources\BerkasMasukResource\Pages;

use App\Filament\Resources\BerkasMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBerkasMasuks extends ListRecords
{
    protected static string $resource = BerkasMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
