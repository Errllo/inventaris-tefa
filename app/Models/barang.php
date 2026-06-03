<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kategori_barang',
        'stok',
        'kondisi_barang'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'barang_id');
    }
}
