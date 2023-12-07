<?php

namespace App\Models;

use App\Models\ImageKedai;
use Illuminate\Support\Facades\DB;
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
        return $this->hasMany(ImageKedai::class)->select([
            'id', 
            'kedai_id', 
            'gambar',
            DB::raw("CONCAT('" . asset('storage/') . "','/', gambar) as url")]);
    }
}
