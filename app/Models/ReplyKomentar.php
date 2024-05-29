<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyKomentar extends Model
{
    use HasFactory;
    protected $table = 'reply_comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'komentar',
        'forum_id',
        'user_id',
        'komentar_id',
    ];
}
