<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'foto_ktp',
        'foto_selfie',
        'deskripsi_pengalaman',
        'foto_sertifikat',
        'status',
        'petani_id',
    ];
}
