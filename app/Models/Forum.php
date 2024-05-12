<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forums';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'deskripsi',
        'user_id',
    ];


    public function images()
    {
        return $this->hasMany(ImageForum::class)->select([
            'id',
            'forum_id',
            'gambar',
            DB::raw("CONCAT('" . asset('storage/') . "','/', gambar) as url")
        ]);
    }
}
