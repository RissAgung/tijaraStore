<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'BARANG';
    protected $primaryKey = 'kode_br';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_br', 'kategori', 'kode_barang_tag', 'nama_br', 'stok', 'gambar', 'harga', 'ukuran', 'warna', 'jenis');


    public function detail_barang_tag()
    {
        return $this->hasMany(detail_barang_tag::class, 'detail_kode_barang_tag', 'kode_barang_tag');
    }
}
