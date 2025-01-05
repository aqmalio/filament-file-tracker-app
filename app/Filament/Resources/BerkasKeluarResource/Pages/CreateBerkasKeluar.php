<?php

namespace App\Filament\Resources\BerkasKeluarResource\Pages;

use App\Filament\Resources\BerkasKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBerkasKeluar extends CreateRecord
{
    protected static string $resource = BerkasKeluarResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
