<?php

namespace App\Models;

use App\Models\ImageBudidaya;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budidaya extends Model
{
    use HasFactory;

    protected $table = 'budidayas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahapan',
        'deskripsi',
        'link',
        'sumber_artikel',
        'credit_gambar'
    ];

    public function images()
    {
        return $this->hasMany(ImageBudidaya::class, 'budidaya_id', 'id');
    }
}
