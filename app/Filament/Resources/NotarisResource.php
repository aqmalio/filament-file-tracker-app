<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotarisResource\Pages;
use App\Filament\Resources\NotarisResource\RelationManagers;
use App\Models\Notaris;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotarisResource extends Resource
{
    protected static ?string $model = Notaris::class;
    protected static ?string $label = "Notaris";
    protected static ?string $navigationLabel = "Notaris";
    protected static ?string $navigationGroup = "Data Master";
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-s-building-library';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $slug = 'notaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('no_hp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('no_hp'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListNotaris::route('/'),
            'create' => Pages\CreateNotaris::route('/create'),
            'edit' => Pages\EditNotaris::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
