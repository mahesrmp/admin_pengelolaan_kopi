<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPembelian extends Model
{
    use HasFactory;
    protected $table = 'permintaan_pembelians';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kopi',
        'gambar',
        'harga',
        'stok',
        'lokasi_pengiriman',
        'deskripsi',
        'pembeli',
        'kualitas',
        'user_id',
    ];
}
