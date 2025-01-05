<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasKeluarResource\Pages;
use App\Filament\Resources\BerkasKeluarResource\RelationManagers;
use App\Models\BerkasKeluar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BerkasKeluarResource extends Resource
{
    protected static ?string $model = BerkasKeluar::class;

    protected static ?string $label = "Berkas Keluar";
    protected static ?string $navigationLabel = "Berkas Keluar";
    protected static ?string $navigationGroup = "Back Office";
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationIcon = 'heroicon-s-document-arrow-up';
    protected static ?string $recordTitleAttribute = 'nomor_blanko_elektronik';
    protected static ?string $slug = 'berkas-keluar';
    protected static ?string $pluralModelLabel = 'Berkas Keluar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBerkasKeluars::route('/'),
            'create' => Pages\CreateBerkasKeluar::route('/create'),
            'edit' => Pages\EditBerkasKeluar::route('/{record}/edit'),
        ];
    }
}
