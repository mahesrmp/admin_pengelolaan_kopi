<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;
    protected $table = 'panens';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahapan',
        'deskripsi',
        'gambar',
        'link',
        'sumber_artikel',
        'credit_gambar'
    ];
}
