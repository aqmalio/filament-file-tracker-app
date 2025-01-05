<?php

namespace App\Filament\Resources\BerkasKeluarResource\Pages;

use App\Filament\Resources\BerkasKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBerkasKeluars extends ListRecords
{
    protected static string $resource = BerkasKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
