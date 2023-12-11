<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'kode_produk',
        'nama_produk',
        'merk',
        'harga_beli',
        'diskon',
        'harga_jual',
        'stok',
    ];
}
