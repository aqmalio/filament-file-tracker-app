<?php

namespace App\Filament\Resources\NotarisResource\Pages;

use App\Filament\Resources\NotarisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotaris extends ListRecords
{
    protected static string $resource = NotarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
