<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'id_pembelian',
        'id_produk',
        'harga_beli',
        'jumlah',
        'subtotal',
    ];
}
