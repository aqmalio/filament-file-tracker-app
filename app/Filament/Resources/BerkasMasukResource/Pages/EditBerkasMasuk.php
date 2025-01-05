<?php

namespace App\Filament\Resources\BerkasMasukResource\Pages;

use App\Filament\Resources\BerkasMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBerkasMasuk extends EditRecord
{
    protected static string $resource = BerkasMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
