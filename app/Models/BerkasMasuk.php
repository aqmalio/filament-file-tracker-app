<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BerkasMasuk extends Model
{
    protected $table = "berkas_masuk";
    protected $fillable = ['nomor','tahun','nama_pemohon','no_hp','notaris_id','nomor_hak','desa_id','layanan_id','jatuh_tempo','is_loket'];
    protected $casts = [
        'is_loket' => 'boolean',
    ];

    public function setJatuhTempoAttribute() {
        $this->attributes['jatuh_tempo'] =  now()->addDays($this->layanan->durasi);
    }

    public function berkasKeluar(): HasMany {
        return $this->hasMany(BerkasKeluar::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function notaris(): BelongsTo
    {
        return $this->belongsTo(Notaris::class);
    }
}
