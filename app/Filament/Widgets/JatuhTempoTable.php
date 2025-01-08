<?php

namespace App\Filament\Widgets;

use App\Models\BerkasMasuk;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class JatuhTempoTable extends BaseWidget
{
    protected static ?string $heading = "Berkas yang akan Jatuh Tempo";
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                BerkasMasuk::query()
            )
            ->columns([
                TextColumn::make('created_at')->label('Tanggal Daftar')->date('d/m/Y'),
                TextColumn::make("jatuh_tempo")->date('d/m/Y'),
                Tables\Columns\TextColumn::make('nomor')->color(Color::Blue)->label('Nomor Berkas')->searchable(),
                Tables\Columns\TextColumn::make('tahun')->label('Tahun'),
                Tables\Columns\TextColumn::make('nama_pemohon')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No HP')->searchable(),
                Tables\Columns\TextColumn::make('notaris.name')->label('Nama Kuasa')->searchable(),
                Tables\Columns\TextColumn::make('desa.name'),
                Tables\Columns\TextColumn::make('layanan.name'),
                Tables\Columns\TextColumn::make('nomor_hak'),
            ])
            ->defaultSort('jatuh_tempo', 'asc')
            ->modifyQueryUsing(function (Builder $query) {
                    return $query->whereDate('jatuh_tempo', '>=', now()->subDay()->format('Y-m-d'));
            })
            ->filters([
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
            ]);

    }
}
