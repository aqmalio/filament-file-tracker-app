<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasKeluarResource\Pages;
use App\Filament\Resources\BerkasKeluarResource\RelationManagers;
use App\Models\BerkasKeluar;
use App\Models\BerkasMasuk;
use App\Models\Notaris;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
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
                Select::make('berkas_masuk_id')->label('Berkas Masuk')->required()->native(false)
                    ->relationship(
                        name: 'berkasMasuk',
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nama_pemohon} {$record->nomor} {$record->tahun}")
                    ->columnSpanFull()
                    ->searchable(['nama_pemohon','nomor', 'tahun']),
                // Forms\Components\TextInput::make('berkasMasuk.nama_pemohon')->label('nama_pemohon'),
                Forms\Components\TextInput::make('nomor_nibel')->label('PRODUK NOMOR NIBEL'),
                Forms\Components\DateTimePicker::make('completed_at')->label('TANGGAL SELESAI')->default(now())->required(),
                Forms\Components\TextInput::make('nomor_blanko_elektronik')->label('NOMOR BLANKO ELEKTRONIK'),
                Select::make('posisi_berkas')->label('POSISI BERKAS FISIK')->options(['Cetak' => 'cetak','Periksa' => 'periksa','Koreksi' => 'koreksi'])->required(),
                Forms\Components\TextInput::make('keterangan')->label('KETERANGAN')->default('Selesai'),
                Forms\Components\Textarea::make('catatan')->label('CATATAN'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('berkasMasuk.nomor')->color(Color::Blue)->label('NOMOR BERKAS')->searchable(),
                Tables\Columns\TextColumn::make('berkasMasuk.tahun')->label('TAHUN'),
                Tables\Columns\TextColumn::make('berkasMasuk.nama_pemohon')->label('PEMOHON')->searchable(),
                Tables\Columns\TextColumn::make('berkasMasuk.notaris.name')->label('NAMA KUASA')->searchable(),
                Tables\Columns\TextColumn::make('nomor_nibel')->label('PRODUK NOMOR NIBEL')->searchable(),
                Tables\Columns\TextColumn::make('berkasMasuk.layanan.name')->label('LAYANAN'),
                Tables\Columns\TextColumn::make('completed_at')->label('TANGGAL SELESAI')->date('d/m/Y H:i')->searchable(),
                // Tables\Columns\TextColumn::make('completed_at')->label('DURASI PENYELESAIAN')->since(),
                Tables\Columns\TextColumn::make('nomor_blanko_elektronik')->label('NOMOR BLANKO ELEKTRONIK')->searchable(),
                Tables\Columns\TextColumn::make('posisi_berkas')->label('POSISI BERKAS FISIK'),
                Tables\Columns\TextColumn::make('keterangan')->label('KETERANGAN'),

            ])
            ->defaultGroup(Group::make('berkasMasuk.id')->label('')
                ->getDescriptionFromRecordUsing(fn (BerkasKeluar $record): string => $record->berkasMasuk->nomor."/".$record->berkasMasuk->tahun))
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('posisi_berkas')
                    ->options([
                        'cetak' => 'Cetak',
                        'periksa' => 'Periksa',
                        'koreksi' => 'Koreksi',
                    ]),
                Tables\Filters\SelectFilter::make('berkasMasuk.tahun')->options(
                    range(now()->year - 4, now()->year + 5)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     // Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
