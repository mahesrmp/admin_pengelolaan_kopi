<?php

namespace App\Models;

use App\Models\Kedai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageKedai extends Model
{
    use HasFactory;
    protected $table = 'image_kedais';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar'
    ];

    public function kedai()
    {
        return $this->belongsTo(Kedai::class);
    }
}
