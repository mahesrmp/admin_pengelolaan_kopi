<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageForum extends Model
{
    use HasFactory;
    protected $table = 'image_forums';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
