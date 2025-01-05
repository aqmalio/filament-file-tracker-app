<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasMasukResource\Pages;
use App\Models\BerkasMasuk;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Desa;
use App\Models\Layanan;
use App\Models\Notaris;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BerkasMasukResource extends Resource
{
    protected static ?string $model = BerkasMasuk::class;
    protected static ?string $label = "Berkas Masuk";
    protected static ?string $navigationLabel = "Berkas Masuk";
    protected static ?string $navigationGroup = "Loket";
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-s-document-arrow-down';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $slug = 'berkas-masuk';
    protected static ?string $pluralModelLabel = 'Berkas Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')->label('Nomor Berkas/Tahun')->required(),
                Select::make('layanan_id')->label('Jenis Layanan')->required()->native(false)->searchable()
                    ->options(Layanan::get()->pluck('name','id')),
                Forms\Components\TextInput::make('nama_pemohon')->required(),
                Select::make('notaris_id')->label('Nama Kuasa')->required()->native(false)->searchable()
                    ->options(Notaris::get()->pluck('name','id')),
                Select::make('desa_id')->label('Desa')->required()->native(false)->searchable()
                    ->options(Desa::get()->pluck('name','id')),
                Forms\Components\TextInput::make('nomor_hak')->label('Nomor Hak/Nomor Nibel')->required(),
                Forms\Components\Toggle::make('is_loket')->label('Checklist Sudah di Loket')->inline(false)->accepted()->onColor('success')->onIcon('heroicon-o-check')->offColor('danger')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Daftar')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('nomor')->color(Color::Blue)->label('Nomor Berkas/Tahun')->searchable(),
                Tables\Columns\TextColumn::make('nama_pemohon')->searchable(),
                Tables\Columns\TextColumn::make('notaris.name')->label('Nama Kuasa'),
                Tables\Columns\TextColumn::make('notaris.no_hp')->label('No HP'),
                Tables\Columns\TextColumn::make('desa.name'),
                Tables\Columns\TextColumn::make('layanan.name'),
                Tables\Columns\TextColumn::make('nomor_hak'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('notaris_id')
                    ->options(Notaris::get()->pluck('name','id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBerkasMasuks::route('/'),
            'create' => Pages\CreateBerkasMasuk::route('/create'),
            'edit' => Pages\EditBerkasMasuk::route('/{record}/edit'),
        ];
    }
}
