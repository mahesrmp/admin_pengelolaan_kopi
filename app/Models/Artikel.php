<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul_artikel',
        'isi_artikel',
        'user_id',
    ];


    public function images()
    {
        return $this->hasMany(ImageArtikel::class);
    }
}
