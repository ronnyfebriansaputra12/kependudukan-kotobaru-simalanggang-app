<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengajuan extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik_penduduk', 'nik');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat', 'id');
    }
}
