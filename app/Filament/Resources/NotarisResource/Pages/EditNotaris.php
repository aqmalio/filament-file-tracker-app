<?php

namespace App\Filament\Resources\NotarisResource\Pages;

use App\Filament\Resources\NotarisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotaris extends EditRecord
{
    protected static string $resource = NotarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
