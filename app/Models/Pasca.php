<?php

namespace App\Models;

use App\Models\ImagePasca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasca extends Model
{
    use HasFactory;
    protected $table = 'pascas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahapan',
        'deskripsi',
        'link',
        'sumber_artikel',
        'credit_gambar'
    ];

    public function images()
    {
        return $this->hasMany(ImagePasca::class, 'pasca_id', 'id');
    }
}
