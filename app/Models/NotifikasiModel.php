<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_pengumuman',
        'isi',
        'berkas'
    ];

    protected $table = "notifikasi";

}
