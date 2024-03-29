<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surats';
    protected $fillable = [
        'name_surat',
        // Kolom-kolom lain yang mungkin Anda miliki
    ];
}
