<?php

namespace App\Models;

use App\Models\ImageKedai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kedai extends Model
{
    use HasFactory;
    protected $table = 'kedais';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kedai',
        'alamat',
        'deskripsi',
        'jam_buka',
        'jam_tutup',
        'hari_buka',
        'hari_tutup',
        'hari_buka_lainnya',
        'hari_tutup_lainnya',
        'jam_buka_lainnya',
        'jam_tutup_lainnya',
        'no_telp',
        'credit_gambar'
    ];

    public function images()
    {
        return $this->hasMany(ImageKedai::class, 'kedai_id', 'id');
    }
}
