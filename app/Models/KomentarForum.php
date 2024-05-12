<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarForum extends Model
{
    use HasFactory;
    protected $table = 'forum_komentars';
    protected $primaryKey = 'id';

    protected $fillable = [
        'komentar',
        'forum_id',
        'user_id',
    ];
}
