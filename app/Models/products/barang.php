<?php

namespace App\Models\products;

use App\Models\discounts\discount;
use App\Models\riwayat\detail_transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'kode_br';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = array('kode_br', 'kategori', 'kode_barang_tag', 'nama_br', 'stok', 'gambar', 'harga', 'ukuran', 'warna', 'jenis', 'created_at', 'updated_at');


    public function detail_barang_tag()
    {
        return $this->hasMany(detail_barang_tag::class, 'detail_kode_barang_tag', 'kode_barang_tag');
    }

    public function diskon()
    {
        return $this->hasOne(discount::class, 'kode_diskon', 'kode_diskon');
    }

    public function detail_transaksi(){
        $this->hasMany(detail_transaksi::class, 'kode_br', 'kode_br');
    }
}
