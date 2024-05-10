<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarArtikel extends Model
{
    use HasFactory;
    protected $table = 'artikel_komentars';
    protected $primaryKey = 'id';

    protected $fillable = [
        'komentar',
        'artikel_id',
        'user_id',
    ];
}
