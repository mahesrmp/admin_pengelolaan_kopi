<?php

namespace App\Models;

use App\Models\ImageBudidaya;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panen extends Model
{
    use HasFactory;
    protected $table = 'panens';
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
        return $this->hasMany(ImagePanen::class, 'panen_id', 'id');
    }
}
