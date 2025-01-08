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
use App\Tables\Columns\JatuhTempo;
use Carbon\CarbonInterval;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\TextInput::make('nomor')->label('Nomor Berkas')->required(),
                Forms\Components\TextInput::make('tahun')->label('Tahun')->default(now()->format('Y'))->required(),
                Select::make('layanan_id')->label('Jenis Layanan')->required()->native(false)->searchable()
                    ->options(Layanan::get()->pluck('name','id'))->columnSpanFull(),
                Forms\Components\Hidden::make('jatuh_tempo'),
                Forms\Components\TextInput::make('nama_pemohon')->required(),
                Forms\Components\TextInput::make('no_hp')->required(),
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
                Tables\Columns\TextColumn::make('jatuh_tempo')->label('Jatuh Tempo')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('nomor')->color(Color::Blue)->label('Nomor Berkas')->searchable(),
                Tables\Columns\TextColumn::make('tahun')->label('Tahun'),
                Tables\Columns\TextColumn::make('nama_pemohon')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No HP')->searchable(),
                Tables\Columns\TextColumn::make('notaris.name')->label('Nama Kuasa')->searchable(),
                Tables\Columns\TextColumn::make('desa.name'),
                Tables\Columns\TextColumn::make('layanan.name'),
                Tables\Columns\TextColumn::make('nomor_hak'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('notaris_id')
                    ->options(Notaris::get()->pluck('name','id')),
                Tables\Filters\SelectFilter::make('tahun')->options(
                    range(now()->year - 4, now()->year + 5)),
                Filter::make('jatuh_tempo')
                    ->form([
                        DatePicker::make('jatuh_tempo_date')->label("Tanggal Jatuh Tempo"),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['jatuh_tempo_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('jatuh_tempo', '=', $date),
                            );
                    })
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
