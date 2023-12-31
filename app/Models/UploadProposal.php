<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadProposal extends Model
{
    use HasFactory;

    protected $guarded = [
        // 'NIM',
        // 'dosen_pembimbing',
        // 'jenis_sidang',
        // 'judul',
        // 'berkas',
        // 'email',
        // 'jadwal_sidang',
        // 'pukul',
        // 'link_zoom',
        // 'status',
        'id',
    ];

    protected $table = "proposal";


    public function allMahasiswa() {
        return $this->hasMany(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'email');
    }

}
