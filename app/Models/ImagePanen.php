<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePanen extends Model
{
    use HasFactory;
    protected $table = 'image_panens';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar'
    ];

    public function panen()
    {
        return $this->belongsTo(Panen::class);
    }
}
