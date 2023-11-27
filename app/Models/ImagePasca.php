<?php

namespace App\Models;

use App\Models\Pasca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagePasca extends Model
{
    use HasFactory;
    protected $table = 'image_pascas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar'
    ];

    public function pasca()
    {
        return $this->belongsTo(Pasca::class);
    }
}
