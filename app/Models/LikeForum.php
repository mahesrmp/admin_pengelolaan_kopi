<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeForum extends Model
{
    use HasFactory;
    protected $table = 'forum_likes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'like',
        'forum_id',
        'user_id',
    ];
}
