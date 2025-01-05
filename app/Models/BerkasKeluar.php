<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasKeluar extends Model
{
    protected $table = "berkas_keluar";
    protected $fillable = ['nomor_nibel','completed_at','nomor_blanko_elektronik','posisi_berkas','keterangan','catatan'];
}
