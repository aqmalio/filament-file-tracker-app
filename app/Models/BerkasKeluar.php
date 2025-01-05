<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BerkasKeluar extends Model
{
    protected $table = "berkas_keluar";
    protected $fillable = ['berkas_masuk_id','nomor_nibel','completed_at','nomor_blanko_elektronik','posisi_berkas','keterangan','catatan'];

    public function berkasMasuk(): BelongsTo {
        return $this->belongsTo(BerkasMasuk::class);
    }
}
